<?php

namespace LANMS\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'LANMS\Model' => 'LANMS\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Only register Passport routes if keys exist
        if (file_exists(storage_path('oauth-private.key')) && file_exists(storage_path('oauth-public.key'))) {
            Passport::routes();
        }
    }
}
