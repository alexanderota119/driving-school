<?php

namespace App\Rules;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RuleGroups
{
    public static function EmailRules($table, $ignore_id, $tenant_id, bool $required = true)
    {
        $rules = [
            Rule::unique($table, 'email')->ignore($ignore_id)->where('tenant_id', $tenant_id),
            //'email:rfc,dns',
        ];

        if ($required) {
            $rules[] = 'required';
        }

        return $rules;
    }

    public static function PasswordRule(bool $required = false)
    {
        $rules = [
            'confirmed',
        ] + Password::min(8)->sometimes();

        if ($required) {
            $rules[] = 'required';
        }

        return $rules;
    }
}
