<?php namespace inkvizytor\FluentForm\Extensions;

/**
 * Class CssExtension
 *
 * @package inkvizytor\FluentForm
 */
trait CssExtension
{
    /** @var array */
    protected $css = [];

    /**
     * @param string $class
     * @return bool
     */
    public function hasClass($class)
    {
        return in_array($class, $this->css);
    }

    /**
     * @param string $class
     * @return $this
     */
    public function addClass($class)
    {
        if (!$this->hasClass($class))
        {
            $this->css[] = $class;
        }

        return $this;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function removeClass($class)
    {
        if (in_array($class, $this->css))
        {
            if (($key = array_search($class, $this->css)) !== false)
            {
                unset($this->css[$key]);
            }
        }

        return $this;
    }

    /**
     * @param array $css
     * @return $this
     */
    public function css($css)
    {
        if (func_num_args() > 1)
        {
            $css = func_get_args();
        }

        if (!is_array($css))
        {
            $css = explode(' ', $css);
        }

        $this->css = $css;

        return $this;
    }

    /**
     * @return array
     */
    public function getCss()
    {
        return $this->css;
    }

    /**
     * @return string
     */
    public function getCssString()
    {
        return implode(' ', $this->css);
    }

    /**
     * @return array
     */
    public function getCssAttr()
    {
        return ['class' => $this->getCssString()];
    }
}
