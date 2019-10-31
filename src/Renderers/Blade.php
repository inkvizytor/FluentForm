<?php namespace inkvizytor\FluentForm\Renderers;

use inkvizytor\FluentForm\Base\Field;
use inkvizytor\FluentForm\Base\Control;
use inkvizytor\FluentForm\Renderers\Base;
use inkvizytor\FluentForm\Controls\Elements\Group;

class Blade extends Base
{
    /**
     * @param \inkvizytor\FluentForm\Base\Control $control
     * @return array
     */
    protected function getClasses(Control $control)
    {
        $type = get_class($control);
        
        return array_map(
            function($type) { return class_basename($type); },
            array_merge([$type => $type], class_parents($control))
        );
    }

    /**
     * @param \inkvizytor\FluentForm\Base\Control $control
     * @param string $prefix
     * @param string $layout
     * @return array
     */
    protected function getViews(Control $control = null, $prefix = 'forms', $layout = null)
    {
        $settings = [];

        if ($control != null)
        {
            $classes = $this->getClasses($control);
            
            foreach ($classes as $type => $class)
            {
                if ($layout !== null)
                {
                    $settings[strtolower("$prefix.$class-$layout")] = 'control';
                }
                $settings[strtolower("$prefix.$class")] = 'control';
            }
        }
        else if ($layout !== null)
        {
            $settings[strtolower("$prefix.group-$layout")] = 'group';
            $settings[strtolower("$prefix.group")] = 'group';
        }
        
        return array_keys($settings);
    }

    /**
     * @param string $layout
     * @param Control $control
     * @param \inkvizytor\FluentForm\Controls\Elements\Group $group
     */
    public function extend($layout, Control $control = null, Group $group = null)
    {
        if ($control != null)
        {
            $views = $this->getViews($control, 'forms.extenders', $layout);
            $views = array_merge($views, ['forms.extenders.empty']);

            view()
                ->first($views, [
                    'control' => $control, 
                    'group' => $group, 
                    'renderer' => $this
                ])
                ->render();
        }
    }

    /**
     * @param string $layout
     * @param Control $control
     * @param Group $group
     * @return string
     */
    public function render($layout, Control $control = null, Group $group = null)
    {
        if ($control != null)
        {
            if ($this->mode == self::RENDER_GROUP)
            {
                $views = $this->getViews($control, 'forms', $layout);
                $views = array_merge($views, ['forms.control']);
                
                return view()
                    ->first($views, [
                        'control' => $control, 
                        'group' => $group, 
                        'renderer' => $this
                    ])
                    ->render();
            }
            
            return $this->decorate($control);
        }

        if ($group != null)
        {
            $methods = $this->getViews(null, 'forms', $layout);
            $views = $this->getViews(null, 'forms', $layout);
            
            return view()
                ->first($views, [
                    'group' => $group, 
                    'renderer' => $this
                ])
                ->render();
        }

        return '';
    }

    /**
     * @param Control $control
     * @return mixed
     */
    public function decorate(Control $control)
    {
        $views = $this->getViews($control, 'forms.decorators');
        $views = array_merge($views, ['forms.decorators.clean']);
        
        return view()
            ->first($views, [
                'control' => $control, 
                'renderer' => $this
            ])
            ->render();
    }

    /**
     * @param array $attributes
     * @return string
     */
    public function attr(array $attributes)
    {
        return $this->html()->attr($attributes);
    }

    /**
     * @param Field $control
     * @return string
     */
    public function hasErrors(Field $control)
    {
        foreach ($this->getErrorMessages($control->getKey()) as $message)
        {
            return true;
        }

        return false;
    }
}
