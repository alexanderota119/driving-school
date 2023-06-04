<?php

namespace App\Http\Requests;

use App\Rules\RuleGroups;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

abstract class BaseFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [];

        if (method_exists($this, 'shared')) {
            $rules = [...$rules, ...$this->shared()];
        }

        $request_based_rules = match ($this->method()) {
            'POST' => $this->store(),
            'PUT', 'PATCH' => $this->update(),
            'DELETE' => $this->destroy(),
            default  => []
        };

        $rtv = [...$rules, ...$request_based_rules];

        return $rtv;
    }

    protected function shared(): array
    {
        return [];
    }

    protected function store(): array
    {
        return [];
    }

    protected function update(): array
    {
        return [];
    }

    protected function destroy(): array
    {
        return [];
    }

    public function addAddress(bool $required = false)
    {
        $is_required = $required ? ['required'] : [];

        return [
            'address.street1'  => $is_required,
            'address.street2'  => [],
            'address.city'     => $is_required,
            'address.state_id' => $is_required,
            'address.zipcode'  => $is_required,
        ];
    }

    public function addEmail(string $table = 'users', bool $required = true)
    {
        return [
            'email' => RuleGroups::EmailRules(
                table: $table,
                ignore_id: $this->id,
                tenant_id: $this->tenant_id,
                required: $required
            ),
        ];
    }

    public function addPassword(bool $required = true): array
    {
        return [
            'password' => RuleGroups::PasswordRule(
                required: $required
            ),
        ];
    }

    public function addFile($param_name = 'file'): array
    {
        return [
            $param_name => [
                File::image(),
            ],
        ];
    }
}
