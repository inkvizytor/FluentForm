<?php namespace inkvizytor\FluentForm\Base;

use inkvizytor\FluentForm\Contracts\IHasCss;
use inkvizytor\FluentForm\Extensions\CssExtension;

/**
 * Class ViewComponent
 *
 * @package inkvizytor\FluentForm\Base
 */
abstract class ViewComponent extends Component implements IHasCss
{
    use CssExtension;

    /** @var string */
    protected $label;

    /** @var string */
    protected $help;

    /** @var bool */
    protected $required;

    /** @var  bool */
    protected $sronly;

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
     * @param bool $value
     * @return $this
     */
    public function disabled($value = true)
    {
        $this->attr('disabled', $value ? 'disabled' : null);

        return $this;
    }

    /**
     * @return bool
     */
    public function isDisabled()
    {
        return $this->hasAttr('disabled');
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function readonly($value = true)
    {
        $this->attr('readonly', $value ? 'readonly' : null);

        return $this;
    }

    /**
     * @return bool
     */
    public function isReadonly()
    {
        return $this->hasAttr('readonly');
    }

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
     * @param string $label
     * @param array $parameters
     * @param string $domain
     * @param string|null $locale
     * @return $this
     */
    public function help($label, array $parameters = [], $domain = 'messages', $locale = null)
    {
        $this->help = $this->root()->translator()->trans($label, $parameters, $domain, $locale);

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
}
