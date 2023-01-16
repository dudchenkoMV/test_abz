<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        preg_match('/\+380 \([0-9]{2}\) [0-9]{3} [0-9]{2} [0-9]{2}/', $value, $matches);

        return !empty($matches);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The pattern phone number have to be equal: "+380 (XX) XXX XX XX"';
    }
}
