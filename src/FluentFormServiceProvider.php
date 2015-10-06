<?php namespace inkvizytor\FluentForm;

use Collective\Html\HtmlServiceProvider;
use inkvizytor\FluentForm\Renderers\Base as BaseRenderer;
use inkvizytor\FluentForm\Validation\Base as BaseValidation;

/**
 * Class FluentFormServiceProvider
 *
 * @package inkvizytor\FluentForm
 */
class FluentFormServiceProvider extends HtmlServiceProvider
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
        parent::register();

        $this->mergeConfigFrom(
            __DIR__.'/config.php', 'fluentform'
        );

        $this->app->bind(BaseRenderer::class, config('fluentform.renderer'));
        $this->app->bind(BaseValidation::class, config('fluentform.validation'));
        
        $this->app->bind('FluentForm', function ($app)
        {
            return app()->make(FluentFormBuilder::class);
        });
    }

    /**
     * Register the form builder instance.
     *
     * @return void
     */
    protected function registerFormBuilder()
    {
        $this->app->singleton('form', function($app)
        {
            $form = new FormBuilderWrapper($app['html'], $app['url'], $app['session.store']->getToken());

            return $form->setSessionStore($app['session.store']);
        });
    }
    
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array_merge(parent::provides(), ['FluentForm']);
    }
} 