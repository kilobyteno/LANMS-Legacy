<?php

namespace LANMS\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use InvalidArgumentException;

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
        try {
            return Carbon::now()->diff(Carbon::createFromFormat('Y-m-d', $value))->y >= $this->minAge;
        } catch (InvalidArgumentException $e) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.OlderThan', ['age' => $this->minAge]);
    }
}
