<?php namespace inkvizytor\FluentForm\Controls;

class Textarea extends Control
{
	/** @var array */
	protected $guarded = ['value'];

	/** @var string */
	protected $rows = 10;
	
	/** @var string */
	protected $value;

	/**
	 * @param string $value
	 * @return $this
	 */
	public function value($value)
	{
		$this->value = $value;

		return $this;
	}

	/**
	 * @param string $rows
	 * @return $this
	 */
	public function rows($rows)
	{
		$this->rows = $rows;

		return $this;
	}
	
	/**
	 * @return string
	 */
	public function render()
	{
		return $this->getForm()->textarea($this->name, $this->value, $this->getOptions());
	}
} 