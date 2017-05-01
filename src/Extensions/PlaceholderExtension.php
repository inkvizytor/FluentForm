<?php namespace inkvizytor\FluentForm\Extensions;

/**
 * Class PlaceholderExtension
 *
 * @package inkvizytor\FluentForm
 */
trait PlaceholderExtension
{
    /** @var string */
    protected $placeholder;

    /**
     * @param string $label
     * @param array $parameters
     * @param string $domain
     * @param string|null $locale
     * @return $this
     */
    public function placeholder($label, array $parameters = [], $domain = 'messages', $locale = null)
    {
        $this->placeholder = $this->root()->translator()->trans($label, $parameters, $domain, $locale);

        return $this;
    }

    /**
     * @return string
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }
}
