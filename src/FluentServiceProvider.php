<?php namespace inkvizytor\FluentForm;

use Illuminate\Support\ServiceProvider;
use inkvizytor\FluentForm\Renderers\Base as BaseRenderer;
use inkvizytor\FluentForm\Validation\Base as BaseValidation;

/**
 * Class FluentServiceProvider
 *
 * @package inkvizytor\FluentForm
 */
class FluentServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'fluentform');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'fluentform');

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('fluentform.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../lang' => base_path('resources/lang/vendor/fluentform'),
        ], 'lang');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'fluentform');

        $renderer = config('fluentform.renderer');
        $validation = config('fluentform.validation');
        
        $this->app->bind(BaseRenderer::class, config('fluentform.renderers.'.$renderer));
        $this->app->bind(BaseValidation::class, config('fluentform.validators.'.$validation));

        $this->app->bind('FluentForm', function ($app)
        {
            return app()->make(config('fluentform.form'));
        });

        $this->app->bind('FluentHtml', function ($app)
        {
            return app()->make(config('fluentform.html'));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['FluentForm', 'FluentHtml'];
    }
} 