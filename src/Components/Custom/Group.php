<?php namespace inkvizytor\FluentForm\Components\Custom;

use inkvizytor\FluentForm\Base\Component;
use inkvizytor\FluentForm\Base\Control;
use inkvizytor\FluentForm\Base\RawComponent;
use inkvizytor\FluentForm\Extensions\CssExtension;
use inkvizytor\FluentForm\Extensions\GroupSizeExtension;
use inkvizytor\FluentForm\Traits\ControlsContract;
use inkvizytor\FluentForm\Traits\CustomContract;
use inkvizytor\FluentForm\Traits\ComplexContract;

/**
 * Class Group
 *
 * @package inkvizytor\FluentForm
 */
class Group extends Component
{
    use ControlsContract, ComplexContract, CustomContract, CssExtension, GroupSizeExtension;

    /** @var string */
    protected $label;

    /** @var  bool */
    protected $sronly;

    /** @var bool */
    protected $required;

    /**
     * @param string $label
     * @param array $parameters
     * @param string $domain
     * @param string|null $locale
     * @return $this
     */
    public function label($label, array $parameters = [], $domain = 'messages', $locale = null)
    {
        $this->label = $this->root()->translator()->trans($label, $parameters, $domain, $locale);

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param bool $required
     * @return $this
     */
    public function required($required)
    {
        $this->required = $required;

        return $this;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @param bool $sronly
     * @return $this
     */
    public function sronly($sronly)
    {
        $this->sronly = $sronly;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSrOnly()
    {
        return $this->sronly;
    }
    
    /**
     * @param Control|string $content
     * @return $this
     */
    public function add($content)
    {
        if ($content instanceof Component)
        {
            $this->addComponent($content->setParent($this));
        }
        elseif (is_string($content))
        {
            $this->addComponent(new RawComponent($this, $content));
        }
        
        return $this;
    }

    /**
     * Set size of the controls in horizontal form
     *
     * @param int $lg
     * @param int $md
     * @param int $sm
     * @param int $xs
     * @return $this
     */
    public function fieldSize($lg = null, $md = null, $sm = null, $xs = null)
    {
        $this->setFieldSize($lg, $md, $sm, $xs);
        
        return $this;
    }

    /**
     * Set size of the label in horizontal form
     *
     * @param int $lg
     * @param int $md
     * @param int $sm
     * @param int $xs
     * @return $this
     */
    public function labelSize($lg = null, $md = null, $sm = null, $xs = null)
    {
        $this->setLabelSize($lg, $md, $sm, $xs);

        return $this;
    }

    /**
     * @return string
     */
    public function renderComponent()
    {
        return get_class($this);
    }
}
