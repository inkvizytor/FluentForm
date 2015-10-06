<?php namespace inkvizytor\FluentForm\Base;

/**
 * Class HtmlBuilder
 *
 * @package inkvizytor\FluentForm\Base
 */
class HtmlBuilder
{
    /**
     * @param array $attributes
     * @return string
     */
    public function attributes(array $attributes)
    {
        $html = '';

        foreach ($attributes as $key => $value)
        {
            if (is_numeric($key)) $key = $value;
            if (is_null($value)) continue;

            $html .= ' '.$key.'="'.$this->encode($value).'"';
        }

        return $html;
    }

    /**
     * @param string $value
     * @return string
     */
    public function encode($value)
    {
        return htmlentities($value, ENT_QUOTES, 'UTF-8', false);
    }

    /**
     * @param string $value
     * @return string
     */
    public function decode($value)
    {
        return html_entity_decode($value, ENT_QUOTES, 'UTF-8');
    }
}