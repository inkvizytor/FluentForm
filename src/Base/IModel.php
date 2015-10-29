<?php namespace inkvizytor\FluentForm\Base;

/**
 * Interface IModel
 *
 * @package inkvizytor\FluentForm
 */
interface IModel
{
    /**
     * @return array
     */
    public function rules();
    
    /**
     * @return \Illuminate\Support\MessageBag
     */
    public function errors();
}