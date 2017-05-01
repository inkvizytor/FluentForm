<?php namespace inkvizytor\FluentForm\Contracts;

/**
 * Interface IRootComponent
 *
 * @package inkvizytor\FluentForm
 */
interface IRootComponent extends IComponent
{
    /**
     * @param mixed $model
     * @return $this
     */
    public function model($model);

    /**
     * @param mixed $rules
     * @return $this
     */
    public function rules($rules);

    /**
     * @param \Illuminate\Support\MessageBag|\Illuminate\Support\ViewErrorBag $errors
     * @return $this
     */
    public function errors($errors);

    /**
     * @return \inkvizytor\FluentForm\Html\Builder
     */
    public function html();

    /**
     * @return \inkvizytor\FluentForm\Renderers\Base
     */
    public function renderer();

    /**
     * @return \inkvizytor\FluentForm\Model\Binder
     */
    public function binder();

    /**
     * @return \inkvizytor\FluentForm\Validation\Base
     */
    public function validation();

    /**
     * @return \Illuminate\Session\Store
     */
    public function session();

    /**
     * @return \Illuminate\Routing\UrlGenerator
     */
    public function locator();

    /**
     * @return \Illuminate\Http\Request
     */
    public function request();

    /**
     * @return \Illuminate\Translation\Translator
     */
    public function translator();

    /**
     * @param string $key
     * @param null $default
     * @return string|array
     */
    public function config($key, $default = null);
}
