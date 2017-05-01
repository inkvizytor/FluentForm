<?php namespace inkvizytor\FluentForm\Extensions;

/**
 * Class ComponentSizeExtension
 *
 * @package inkvizytor\FluentForm
 */
trait ComponentSizeExtension
{
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
