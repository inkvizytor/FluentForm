<?php namespace inkvizytor\FluentForm\Traits;

/**
 * Class SizeContract
 *
 * @package inkvizytor\FluentForm
 */
trait SizeContract
{
    /**
     * @var array
     */
    private $fieldSize = [
        'lg' => null,
        'md' => null,
        'sm' => null,
        'xs' => null
    ];

    /**
     * @var array
     */
    private $labelSize = [
        'lg' => null,
        'md' => null,
        'sm' => null,
        'xs' => null
    ];
    
    /**
     * Set size of the controls in horizontal form
     *
     * @param int $lg
     * @param int $md
     * @param int $sm
     * @param int $xs
     * @return $this
     */
    public function setFieldSize($lg = null, $md = null, $sm = null, $xs = null)
    {
        if (!empty($lg)) $this->fieldSize['lg'] = $lg;
        if (!empty($md)) $this->fieldSize['md'] = $md;
        if (!empty($sm)) $this->fieldSize['sm'] = $sm;
        if (!empty($xs)) $this->fieldSize['xs'] = $xs;

        return $this;
    }

    /**
     * Get size of the controls in horizontal form
     *
     * @param string $screen
     * @return array
     */
    public function getFieldSize($screen)
    {
        return array_get($this->fieldSize, $screen);
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
    public function setLabelSize($lg = null, $md = null, $sm = null, $xs = null)
    {
        if (!empty($lg)) $this->labelSize['lg'] = $lg;
        if (!empty($md)) $this->labelSize['md'] = $md;
        if (!empty($sm)) $this->labelSize['sm'] = $sm;
        if (!empty($xs)) $this->labelSize['xs'] = $xs;

        return $this;
    }

    /**
     * Get size of the label in horizontal form
     *
     * @param string $screen
     * @return array
     */
    public function getLabelSize($screen)
    {
        return array_get($this->labelSize, $screen);
    }

    /**
     * @param int $fieldSize
     * @param int $labelSize
     * @return $this
     */
    public function large($fieldSize, $labelSize)
    {
        $this->setFieldSize($fieldSize);
        $this->setLabelSize($labelSize);

        return $this;
    }

    /**
     * @param int $fieldSize
     * @param int $labelSize
     * @return $this
     */
    public function medium($fieldSize, $labelSize)
    {
        $this->setFieldSize(null, $fieldSize);
        $this->setLabelSize(null, $labelSize);

        return $this;
    }

    /**
     * @param int $fieldSize
     * @param int $labelSize
     * @return $this
     */
    public function small($fieldSize, $labelSize)
    {
        $this->setFieldSize(null, null, $fieldSize);
        $this->setLabelSize(null, null, $labelSize);

        return $this;
    }

    /**
     * @param int $fieldSize
     * @param int $labelSize
     * @return $this
     */
    public function tiny($fieldSize, $labelSize)
    {
        $this->setFieldSize(null, null, null, $fieldSize);
        $this->setLabelSize(null, null, null, $labelSize);

        return $this;
    }
}