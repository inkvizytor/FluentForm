<?php namespace inkvizytor\FluentForm\Model;

use Illuminate\Http\Request;
use Illuminate\Session\Store as Session;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;

/**
 * Class Binder
 *
 * @package inkvizytor\FluentForm
 */
class Binder
{
    /** @var mixed */
    protected $model;

    /** @var \Illuminate\Session\Store */
    protected $session;

    /** @var \Illuminate\Http\Request */
    protected $request;

    /**
     * @param \Illuminate\Session\Store $session
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Session $session, Request $request)
    {
        $this->session = $session;
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Session\Store
     */
    private function session()
    {
        return $this->session;
    }

    /**
     * @return \Illuminate\Http\Request
     */
    private function request()
    {
        return $this->request;
    }

    /**
     * @return bool
     */
    private function submit()
    {
        return in_array($this->request()->method(), ['POST', 'DELETE', 'PATCH', 'PUT']);
    }

    /**
     * @param mixed $model
     * @return $this
     */
    public function model($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function value($key, $value = null)
    {
        return $this->old($key, $this->post($key, $this->data($key, $value)));
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    private function post($key, $default = null)
    {
        return Arr::get($this->request()->request->all(), $key, $default);
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    private function old($key, $default = null)
    {
        return $this->request()->old($key, $default);
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    private function data($key, $default = null)
    {
        return data_get($this->model, $key, $default);
    }

    /**
     * @param string $key
     * @param mixed $value
     * @param bool $checked
     * @return bool
     */
    public function checked($key, $value, $checked)
    {
        $data = $this->value($key);
        
        if ($data === null)
        {
            return $checked;
        }

        if (is_array($data))
        {
            return in_array($value, $data);
        }
        else if ($data instanceof Collection)
        {
            return $data->contains('id', $value);
        }

        return strval($data) === strval($value);
    }
}