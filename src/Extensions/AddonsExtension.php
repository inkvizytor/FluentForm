<?php namespace inkvizytor\FluentForm\Extensions;

/**
 * Class AddonsExtension
 *
 * @package inkvizytor\FluentForm
 */
trait AddonsExtension
{
    protected $addons = [
        'prepend' => null,
        'append' => null,
    ];
    
    /**
     * @param mixed $addon
     * @return $this
     */
    public function prepend($addon)
    {
        $this->addons['prepend'] = $addon;

        return $this;
    }

    /**
     * @param mixed $addon
     * @return $this
     */
    public function append($addon)
    {
        $this->addons['append'] = $addon;

        return $this;
    }
}
