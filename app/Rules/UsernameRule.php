<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UsernameRule implements ValidationRule
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

        // match to pattern
        if( preg_match(REGEX_USERNAME,$value) == 0 )
            $fail('the character of :attribute should be just letter or specific characters');

        // length
        if( strlen($value) > USERNAME_LENGTH )
            $fail(':attribute length should not be more than '.USERNAME_LENGTH.' characters.');

    }
}
