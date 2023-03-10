<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NameRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // should be string
        if( gettype($value) != 'string' )
            $fail('the :attribute should be a string');

        // length
        if( strlen($value) > NAME_LENGTH )
            $fail(':attribute length should not be more than '.NAME_LENGTH.' characters.');
    }
}
