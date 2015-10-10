<?php namespace inkvizytor\FluentForm\Html;

/**
 * Class Builder
 *
 * @package inkvizytor\FluentForm
 */
class Builder
{
    private $selfClosing = [
        'area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input',
        'keygen', 'link', 'meta', 'param', 'source', 'track', 'wbr'
    ];

    /**
     * @param string $name
     * @param array $attributes
     * @param string $content
     * @return string
     */
    public function tag($name, array $attributes = [], $content = null)
    {
        $tag  = "\n<{$name}{$this->attr($attributes)}{$this->end($name)}>";
        
        if (!in_array($name, $this->selfClosing) && $content !== null)
        {
            $tag .= "\n".trim($content).$this->close($name);
        }
        
        return $tag;
    }

    /**
     * @param string $name
     * @return string
     */
    public function close($name)
    {
        return in_array($name, $this->selfClosing) ? '' : "\n</$name>";
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
     * @param array $attributes
     * @return string
     */
    public function attr(array $attributes)
    {
        $html = '';

        foreach ($attributes as $key => $value)
        {
            if (is_numeric($key)) $key = $value;
            if ($value === null || $value === false) continue;

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