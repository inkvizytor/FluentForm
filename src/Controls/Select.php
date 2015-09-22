<?php namespace inkvizytor\FluentForm\Controls;

class Select extends Control
{
	/** @var array */
	protected $guarded = ['items', 'selected', 'placeholder'];
	
	/** @var array */
	protected $items;

	/** @var mixed */
	protected $selected;

	/**
	 * @param array $items
	 * @return $this
	 */
	public function items(array $items)
	{
		$this->items = $items;

		return $this;
	}
	
	/**
	 * @param string $selected
	 * @return $this
	 */
	public function selected($selected)
	{
		$this->selected = $selected;

		return $this;
	}
	
	/**
	 * @return string
	 */
	public function render()
	{
		$options = $this->getOptions();
        $options['placeholder'] = $this->placeholder;
		
		return $this->getForm()->select($this->name, $this->items, $this->selected, $options);
	}
} 