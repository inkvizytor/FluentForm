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
        $this->publishes([
            __DIR__.'/config.php' => config_path('fluentform.php'),
        ], 'config');

        $this->loadViewsFrom(__DIR__.'/../views', 'fluentform');
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config.php', 'fluentform'
        );

        $this->app->bind(BaseRenderer::class, config('fluentform.renderer'));
        $this->app->bind(BaseValidation::class, config('fluentform.validation'));
        
        $this->app->bind('FluentForm', function ($app)
        {
            return app()->make(FluentFormBuilder::class);
        });

        $this->app->bind('FluentHtml', function ($app)
        {
            return app()->make(FluentHtmlBuilder::class);
        });
    }
    
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['FluentForm'];
    }
} 