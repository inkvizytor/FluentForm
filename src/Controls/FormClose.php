<?php namespace inkvizytor\FluentForm\Controls;

/**
 * Class FormClose
 *
 * @package inkvizytor\FluentForm\Controls
 */
class FormClose extends BaseControl
{
	/**
	 * @return string
	 */
	public function render()
	{
		return $this->getForm()->close();
	}
} 