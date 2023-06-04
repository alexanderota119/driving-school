<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\BufferedOutput;

class GenerateRequestHelperCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:request-unified {model} {--force : force generate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a request resource for a modal';

    private $hidden_fields = ['created_at', 'email_verified_at', 'updated_at', 'deleted_at'];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $model = $this->argument('model');
        $model_path = "App\\Models\\{$model}";
        $attributes = $this->getModelSpecs();

        // fields to ignore
        $this->info('Getting models hidden fields');
        $hidden_fields = (new $model_path)->getHidden();
        $shared_rules = $this->convertAttributesToRules($attributes, $hidden_fields);
        $newRules = $this->formatRules($shared_rules);

        $this->info('Generating the request class with rules');
        $this->newLine();
        $this->comment($newRules);
        $this->newLine();

        // build the request class
        $request_name = \Str::of($model)->ucfirst()->append('SaveRequest')->toString();
        $response_code = Artisan::call(
            command: 'make:request',
            parameters: [
                'name'    => $request_name,
                '--rule'  => $newRules,
                '--force' => $this->option('force') ?? false,
            ],
        );

        $this->info("Generated request file 'App\\Requests\\{$request_name}'");
        $this->newLine();
    }

    private function getModelSpecs(): array
    {
        $output_describe = new BufferedOutput();

        $model_specs_string = Artisan::call(
            command: 'model:show',
            parameters: [
                'model'  => $this->argument('model'),
                '--json' => true,
            ],
            outputBuffer: $output_describe
        );
        $response = $output_describe->fetch();
        $model_specs = json_decode($response, true);

        return $model_specs['attributes'];
    }

    private function convertAttributesToRules($attributes, $model_hidden_fields): array
    {
        $this->info('Converting the returned attributes to rules');
        $shared_rules = [];

        foreach ($attributes as $attribute) {
            // ignore stuff like id, timestamps, and others
            if ($attribute['name'] == 'id' || in_array($attribute['name'], $model_hidden_fields) || in_array($attribute['name'], $this->hidden_fields)) {
                continue;
            }

            $shared_rules[$attribute['name']] = [];

            // if the field is not nullable then its required
            if (! $attribute['nullable']) {
                $shared_rules[$attribute['name']][] = 'required';
            }
        }

        return $shared_rules;
    }

    private function formatRules($rules): string
    {
        $this->info('Formatting the rules for the request stub');
        $newRules = [];
        foreach ($rules as $field_name => $rule) {
            $newRules[] = "            '$field_name' => ['".implode("','", $rule)."']";
        }

        return implode(",\n", $newRules);
    }
}
