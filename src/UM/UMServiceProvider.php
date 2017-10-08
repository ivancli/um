<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 18/02/2017
 * Time: 10:01 PM
 */

namespace IvanCLI\UM;


use Illuminate\Support\ServiceProvider;

class UMServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__ . '/../config/config.php' => app()->basePath() . '/config/um.php',
        ], 'um');
        // Register commands
        $this->commands('command.um.migration');
        // Register blade directives
        $this->bladeDirectives();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerUM();
        $this->registerCommands();
        $this->mergeConfig();
    }

    /**
     * Register the blade directives
     *
     * @return void
     */
    private function bladeDirectives()
    {
        if (!class_exists('\Blade')) return;
        // Call to UM::hasRole
        \Blade::directive('role', function ($expression) {
            return "<?php if (\\UM::hasRole({$expression})) : ?>";
        });
        \Blade::directive('endrole', function ($expression) {
            return "<?php endif; // UM::hasRole ?>";
        });
        // Call to UM::can
        \Blade::directive('permission', function ($expression) {
            return "<?php if (\\UM::can({$expression})) : ?>";
        });
        \Blade::directive('endpermission', function ($expression) {
            return "<?php endif; // UM::can ?>";
        });
        // Call to UM::ability
        \Blade::directive('ability', function ($expression) {
            return "<?php if (\\UM::ability({$expression})) : ?>";
        });
        \Blade::directive('endability', function ($expression) {
            return "<?php endif; // UM::ability ?>";
        });
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerUM()
    {
        $this->app->bind('um', function ($app) {
            return new UM($app);
        });
        $this->app->alias('um', 'IvanCLI\UM\UM');
    }

    /**
     * Register the artisan commands.
     *
     * @return void
     */
    private function registerCommands()
    {
        $this->app->singleton('command.um.migration', function ($app) {
            return new MigrationCommand();
        });
    }

    /**
     * Merges user's and um's configs.
     *
     * @return void
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'um'
        );
    }

    /**
     * Get the services provided.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'command.um.migration'
        ];
    }
}