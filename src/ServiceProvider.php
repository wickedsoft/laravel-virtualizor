<?php

namespace wickedsoft\Virtualizor;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/virtualizor.php' => config_path('virtualizor.php')
        ], 'config');
        \Auth::provider('virtualizor', function ($app, array $config) {
            return new \wickedsoft\Virtualizor\Providers\VirtualizorProvider();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['wickedsoft\Virtualizor\Virtualizor', 'Virtualizor'];
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('wickedsoft\Virtualizor\Virtualizor', function ($app) {
            $virt = new Virtualizor($app);
            $virt->site($virt->getDefaultSite());

            return $virt;
        });
        $this->app->alias('wickedsoft\Virtualizor\Virtualizor', 'Virtualizor');
    }
}
