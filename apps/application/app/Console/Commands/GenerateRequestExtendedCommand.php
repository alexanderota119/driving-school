<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\RequestMakeCommand;
use Symfony\Component\Console\Input\InputOption;

class GenerateRequestExtendedCommand extends RequestMakeCommand
{
    protected function getOptions()
    {
        $options = parent::getOptions();
        $options[] = ['rule', 'r', InputOption::VALUE_REQUIRED, 'Input of the rules to render'];

        return $options;
    }

    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        return str_replace(['{{ rules }}', '{{rules}}'], $this->option('rule'), $stub);
    }
}
