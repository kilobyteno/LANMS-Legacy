<?php

namespace LANMS\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use LANMS\User;

class ModelPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
