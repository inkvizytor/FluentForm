<?php namespace inkvizytor\FluentForm\Html;

/**
 * Class Builder
 *
 * @package inkvizytor\FluentForm
 */
class Builder
{
    private $selfClosing = [
        'area',
        'base',
        'br',
        'col',
        'embed',
        'hr',
        'img',
        'input',
        'keygen',
        'link',
        'meta',
        'param',
        'source',
        'track',
        'wbr'
    ];

    private $inline = [
        'label',
        'span',
        'var',
        'i'
    ];

    private $prefixed = [
        'textarea',
        'button',
        'a'
    ];

    /**
     * @param string $name
     * @param array $attributes
     * @param string $content
     * @return string
     */
    public function tag($name, array $attributes = [], $content = null)
    {
        $tag = $this->nl($name, true)."<{$name}{$this->attr($attributes)}{$this->end($name)}>";

        if (!in_array($name, $this->selfClosing) && $content !== null)
        {
            $tag .= $this->nl($name).trim($content).$this->close($name);
        }

        return $tag;
    }

    /**
     * @param string $name
     * @return string
     */
    public function close($name)
    {
        return in_array($name, $this->selfClosing) ? '' : $this->nl($name)."</$name>";
    }

    /**
     * @param string $name
     * @return string
     */
    private function end($name)
    {
        return in_array($name, $this->selfClosing) ? ' /' : '';
    }

    /**
     * @param string $name
     * @param bool|false $prefix
     * @return string
     */
    private function nl($name, $prefix = false)
    {
        return in_array($name, $this->inline) || (in_array($name, $this->prefixed) && $prefix == false) ? '' : "\n";
    }

    /**
     * @param array $attributes
     * @return string
     */
    public function attr(array $attributes)
    {
        $html = '';

        foreach ($attributes as $key => $value)
        {
            if (is_numeric($key))
            {
                $key = $value;
            }
            if (is_array($value))
            {
                $value = json_encode($value);
            }
            if ($value === null || $value === false)
            {
                continue;
            }

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