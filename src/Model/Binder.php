<?php namespace inkvizytor\FluentForm\Model;

/**
 * Class Binder
 *
 * @package inkvizytor\FluentForm\Model
 */
class Binder
{
    /** @var mixed */
    protected $model;

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
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }
}