<?php namespace inkvizytor\FluentForm\Base;

use inkvizytor\FluentForm\Traits\CssContract;
use inkvizytor\FluentForm\Traits\DataContract;

abstract class Fluent extends Control
{
    use CssContract, DataContract;
    
    /** @var string */
    protected $name;

    /** @var string */
    protected $label;
    
    /** @var  bool */
    protected $sronly;

    /** @var string */
    protected $help;

    /** @var bool */
    protected $required;

    /** @var string */
    protected $disabled;
    
    /** @var string */
    protected $readonly;

    /** @var string */
    protected $placeholder;
    
    /**
     * @var array
     */
    protected $width = [
        'lg' => null,
        'md' => null,
        'sm' => null,
        'xs' => null
    ];

    /**
     * @param string $name
     * @return $this
     */
    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $label
     * @param bool $sronly
     * @return $this
     */
    public function label($label, $sronly = false)
    {
        $this->label = $label;
        $this->sronly = $sronly;

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
     * @param string $text
     * @return $this
     */
    public function help($text)
    {
        $this->help = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getHelp()
    {
        return $this->help;
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
     * @param int $lg
     * @param int $md
     * @param int $sm
     * @param int $xs
     * @return $this
     */
    public function width($lg = null, $md = null, $sm = null, $xs = null)
    {
        $this->width = [
            'lg' => $lg,
            'md' => $md,
            'sm' => $sm,
            'xs' => $xs
        ];

        return $this;
    }

    /**
     * @param int $size
     * @return $this
     */
    public function large($size)
    {
        $this->width['lg'] = $size;

        return $this;
    }

    /**
     * @param int $size
     * @return $this
     */
    public function medium($size)
    {
        $this->width['md'] = $size;

        return $this;
    }

    /**
     * @param int $size
     * @return $this
     */
    public function small($size)
    {
        $this->width['sm'] = $size;

        return $this;
    }

    /**
     * @param int $size
     * @return $this
     */
    public function tiny($size)
    {
        $this->width['xs'] = $size;

        return $this;
    }

    /**
     * @return array
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function disabled($value = true)
    {
        $this->disabled = $value ? 'disabled' : null;
        
        return $this;
    }

    /**
     * @return bool
     */
    public function isDisabled()
    {
        return !empty($this->disabled);
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function readonly($value = true)
    {
        $this->readonly = $value ? 'readonly' : null;
        
        return $this;
    }

    /**
     * @return bool
     */
    public function isReadonly()
    {
        return !empty($this->required);
    }

    /**
     * @param string $label
     * @return $this
     */
    public function placeholder($label)
    {
        $this->placeholder = $label;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * @return array
     */
    protected function getOptions()
    {
        $options = parent::getOptions();
        
        $label = $this->getLabel() ? $this->getLabel() : $this->getPlaceholder();
        $live = $this->renderer()->validation()->getOptions($this->getName(), $label);
        
        return array_merge($live, $options);
    }
    
    /**
     * @return array
     */
    protected function getGuarded()
    {
        return array_merge(['name', 'label', 'help', 'required', 'width'], parent::getGuarded());
    }
} 