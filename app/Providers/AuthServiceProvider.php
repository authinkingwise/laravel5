<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Determine if the user is site admin
        Gate::define('site-admin', function($user){
            if ($user->email == config('app.site_email'))
                return true;
            else
                return false;
        });

        // Dynamically register permissions with Laravel's Gate.
        foreach ($this->getPermissions() as $permission) {
            Gate::define($permission->name, function ($user) use ($permission) {
                return $user->hasPermission($permission);
            });
        }

        Gate::define('check-tenant-role', function($user, $role){
            return $user->tenant_id == $role->tenant_id;
        });

        Gate::define('check-tenant-user', function($user, $showedUser){
            return $user->tenant_id == $showedUser->tenant_id;
        });

        Gate::define('check-tenant-account', function($user, $account){
            return $user->tenant_id == $account->tenant_id;
        });

        Gate::define('check-tenant-contact', function($user, $contact){
            return $user->tenant_id == $contact->tenant_id;
        });
    }

    /**
     * Fetch the collection of site permissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getPermissions()
    {
        try {
            return Permission::with('roles')->get();
        } catch (\Exception $e) {
            return [];
        }
    }
}
