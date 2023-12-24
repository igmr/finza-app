<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        foreach ($this->getServices() as $service) {
            $this->app->bind(
                "App\Services\Interfaces\\{$service}Interface",
                "App\Services\\{$service}Service"
            );
        }
    }

    public function boot(): void
    {
    }

    private function getServices(): array
    {
        return [
            'Account', 'Bank', 'Budget', 'Category', 'Classification', 'Debt',
            'Egress', 'Ingress', 'Saving', 'User', 'Gender',
        ];
    }
}
