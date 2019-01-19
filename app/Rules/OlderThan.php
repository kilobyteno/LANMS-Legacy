<?php

namespace LANMS\Rules;

use Illuminate\Contracts\Validation\Rule;

class OlderThan implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->minAge = 13;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return \Carbon::now()->diff(\Carbon::createFromFormat('Y-m-d', $value))->y >= $this->minAge;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.OlderThan', ['age' => $this->minAge]);
    }
}
