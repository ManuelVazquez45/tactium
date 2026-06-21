<?php

namespace App\Providers;

use App\Models\Equipo;
use App\Policies\EquipoPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        $this->registerPolicies();
    }

    protected function registerPolicies()
    {
        \Illuminate\Support\Facades\Gate::policy(Equipo::class, EquipoPolicy::class);
    }
}
