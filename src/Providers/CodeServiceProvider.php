<?php

namespace Ijeffro\Codes\Providers;

use Illuminate\Support\ServiceProvider;

use Ijeffro\Codes\Generator;
use Ijeffro\Codes\Validator;

use Ijeffro\Codes\Services\CodeGeneratorService;
use Ijeffro\Codes\Services\CodeValidatorService;

use Ijeffro\Codes\Commands\SetupCommand;
use Ijeffro\Codes\Commands\GenerateCodeCommand;
use Ijeffro\Codes\Commands\GenerateCodeBatchCommand;

class CodeServiceProvider extends ServiceProvider
{
    /**
     * Boot the application services.
     */
    public function boot(): void
    {
       $this->loadPackageAssetsFrom();

        if ($this->app->runningInConsole()) {

            $this->loadPublishableAssets();

            $this->commands([
                SetupCommand::class,
                GenerateCodeCommand::class,
                GenerateCodeBatchCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../../config/config.php', 'code');

        /**
         * @see Ijeffro\Codes\Generator
         */
        $this->app->singleton('code', function () {
            return new Generator(new CodeGeneratorService);
        });

        /**
         * @see Ijeffro\Codes\Validator
         */
        $this->app->singleton('code', function () {
            return new Validator(new CodeValidatorService);
        });

    }

    /**
     * Load the Package Assets
     */
    public function loadPackageAssetsFrom(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../../lang', 'code');
        $this->loadMigrationsFrom(__DIR__.'/../../database');
        $this->loadRoutesFrom(__DIR__.'/../../routes/codes.php');
    }

    /**
     * Publish the Package Assets
     */
    public function loadPublishableAssets(): void
    {
        // Package assets
        $this->publishes([
            __DIR__.'/../../config/config.php' => config_path('code.php'),
        ], 'code-config');

        $this->publishes([
            __DIR__.'/../../resources/js/components' => resource_path('js/vendor/code'),
        ], 'code-components');

        $this->publishes([
            __DIR__.'/../../routes/codes.php' => base_path('routes/codes/codes.php')
        ], 'code-routes');

        $this->publishes([
            __DIR__.'/../../database/' => database_path('migrations'),
        ], 'code-migrations');

        $this->publishes([
            __DIR__.'/../../lang' => lang_path(),
        ], 'code-translations');

        $this->publishes([
            __DIR__.'/../Models' => app_path('Models'),
        ], 'code-models');
    }
}
