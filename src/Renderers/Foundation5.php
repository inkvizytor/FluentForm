<?php namespace inkvizytor\FluentForm\Renderers;

use inkvizytor\FluentForm\Base\Control;
use inkvizytor\FluentForm\Base\Field;
use inkvizytor\FluentForm\Components\ButtonGroup;
use inkvizytor\FluentForm\Components\InputGroup;
use inkvizytor\FluentForm\Components\Panel;
use inkvizytor\FluentForm\Controls\Elements\Footer;
use inkvizytor\FluentForm\Controls\Elements\Group;
use inkvizytor\FluentForm\Components\TabStrip;
use inkvizytor\FluentForm\Controls\Button;
use inkvizytor\FluentForm\Controls\Checkable;
use inkvizytor\FluentForm\Controls\CheckableList;
use inkvizytor\FluentForm\Controls\Content;
use inkvizytor\FluentForm\Controls\Input;
use inkvizytor\FluentForm\Components\LinkButton;
use inkvizytor\FluentForm\Controls\Exclusive\DateTime;
use Illuminate\Support\Str;

/**
 * Class Foundation
 *
 * @package inkvizytor\FluentForm
 */
class Foundation5 extends Base
{
    /**
     * @param Field $control
     * @param Group $group
     */
    protected function extendField(Field $control, Group $group = null)
    {
        if ($group != null && $this->hasErrors($control))
        {
            $group->addClass('has-error');
        }
    }

    /**
     * @param Field $control
     * @param \inkvizytor\FluentForm\Controls\Elements\Group $group
     */
    protected function extendFieldInline(Field $control, Group $group = null)
    {
        $this->extendField($control);

        if (!empty($control->getLabel()) && empty($control->getPlaceholder()))
        {
            $control->placeholder($control->getLabel());
            $control->sronly(true);
        }
    }

    /**
     * @param Field $control
     * @param Group $group
     * @return string
     */
    protected function renderFieldStandard(Field $control, Group $group)
    {
        $label = $this->fieldLabel($control);
        $groupCss = array_merge(['row'], $group->getCss());
        $render = $this->decorate($control);

        return '
    <div class="'.implode(' ', $groupCss).'">
        <div class="columns large-12">
            '.$label.'
            '.$this->applyWidth($render, $control->getWidth()).'
            '.$this->renderErrors($control).'
            '.$this->renderHelp($control).'
        </div>
    </div>
        ';
    }

    /**
     * @param Field $control
     * @param Group $group
     * @return string
     */
    protected function renderFieldHorizontal(Field $control, Group $group)
    {
        $label = $this->fieldLabel($control, 'inline right');
        $groupCss = array_merge(['row'], $group->getCss());
        $render = $this->decorate($control);

        return '
    <div class="'.implode(' ', $groupCss).'">
        <div class="'.$this->getLabelColumnClass($group).'">
            '.$label.'
        </div>
        <div class="'.$this->getFieldColumnClass($group).'">
            '.$this->applyWidth($render, $control->getWidth()).'
            '.$this->renderErrors($control).'
            '.$this->renderHelp($control).'
        </div>
    </div>
        ';
    }

    /**
     * @param Field $control
     * @param \inkvizytor\FluentForm\Controls\Elements\Group $group
     * @return string
     */
    protected function renderFieldInline(Field $control, Group $group)
    {
        $groupCss = array_merge(['left'], $group->getCss());
        $render = $this->decorate($control);

        return '
    <div class="'.implode(' ', $groupCss).'">
        '.$render.'
        '.$this->renderErrors($control).'
        '.$this->renderHelp($control).'
    </div>
        ';
    }

    // --------------------------------------------------

    /**
     * @param Control $control
     * @param Group $group
     * @return string
     */
    protected function renderGroupStandard(Control $control = null, Group $group)
    {
        $label = $this->groupLabel($group);
        $groupCss = array_merge(['row'], $group->getCss());
        $render = $group->render();

        return '
    <div class="'.implode(' ', $groupCss).'">
        <div class="columns large-12">
            '.$label.'
            '.$render.'
        </div>
    </div>
        ';
    }

    /**
     * @param Control $control
     * @param Group $group
     * @return string
     */
    protected function renderGroupHorizontal(Control $control = null, Group $group)
    {
        $label = $this->groupLabel($group, 'inline right');
        $groupCss = array_merge(['row'], $group->getCss());
        $render = $group->render();

        return '
    <div class="'.implode(' ', $groupCss).'">
        <div class="'.$this->getLabelColumnClass($group).'">
            '.$label.'
        </div>
        <div class="'.$this->getFieldColumnClass($group).'">
            '.$render.'
        </div>
    </div>
        ';
    }

    /**
     * @param Control $control
     * @param \inkvizytor\FluentForm\Controls\Elements\Group $group
     * @return string
     */
    protected function renderGroupInline(Control $control = null, Group $group)
    {
        $groupCss = array_merge(['left'], $group->getCss());
        $render = $group->render();

        return '
    <div class="'.implode(' ', $groupCss).'">
        '.$render.'
    </div>
        ';
    }

    // --------------------------------------------------

    /**
     * @param Input $control
     * @param Group $group
     */
    protected function extendInput(Input $control, Group $group = null)
    {
        $this->extendField($control, $group);

        if ($control->getType() == 'file')
        {
            $control->removeClass('form-control');
            $control->addClass('filestyle');
            $control->data('icon', 'true');
            $control->data('buttonText', ' ');
        }
    }

    // --------------------------------------------------

    /**
     * @param Checkable $control
     * @param Group $group
     */
    protected function extendCheckable(Checkable $control, Group $group = null)
    {
        if ($control->isDisabled() || $control->isReadonly())
        {
            if ($group != null)
            {
                $group->addClass('disabled');
            }
        }
    }

    /**
     * @param Checkable $control
     * @param Group $group
     * @return string
     */
    protected function renderCheckableStandard(Checkable $control, Group $group)
    {
        $labelCss = $this->getCheckableCss($control);
        $groupCss = array_merge(['row', $labelCss], $group->getCss());

        return '
    <div class="'.implode(' ', $groupCss).'">
        <div class="columns large-12">
            '.$this->decorate($control).'
            '.$this->renderErrors($control).'
            '.$this->renderHelp($control).'
        </div>
    </div>
        ';
    }

    /**
     * @param Checkable $control
     * @param \inkvizytor\FluentForm\Controls\Elements\Group $group
     * @return string
     */
    protected function renderCheckableHorizontal(Checkable $control, Group $group)
    {
        $label = $this->decorate($control);
        $labelCss = $this->getCheckableCss($control);
        $groupCss = array_merge(['row'], $group->getCss());

        return '
    <div class="'.implode(' ', $groupCss).'">
        <div class="'.$this->getLabelColumnClass($group).'"></div>
        <div class="'.$this->getFieldColumnClass($group).'">
            <div class="'.$labelCss.'">'.$label.'</div>
            '.$this->renderErrors($control).'
            '.$this->renderHelp($control).'
        </div>
    </div>
        ';
    }

    /**
     * @param Checkable $control
     * @param Group $group
     * @return string
     */
    protected function renderCheckableInline(Checkable $control, Group $group)
    {
        $labelCss = $this->getCheckableCss($control);
        $groupCss = array_merge(['left', $labelCss], $group->getCss());

        return '
    <div class="'.implode(' ', $groupCss).'">
        '.$this->decorate($control).'
        '.$this->renderErrors($control).'
        '.$this->renderHelp($control).'
    </div>
        ';
    }

    // --------------------------------------------------

    /**
     * @param CheckableList $control
     * @param Group $group
     */
    protected function extendCheckableList(CheckableList $control, Group $group = null)
    {
        if ($control->isInline())
            $control->addClass('inline-list');
        else
            $control->addClass('no-bullet');

        $control->addClass($control->getType());
    }

    /**
     * @param CheckableList $control
     * @param Group $group
     */
    protected function extendCheckableListInline(CheckableList $control, Group $group = null)
    {
        $control->inline(true);

        $this->extendCheckableList($control, $group);
    }

    /**
     * @param CheckableList $control
     * @param Group $group
     * @return string
     */
    protected function renderCheckableListStandard(CheckableList $control, Group $group)
    {
        $label = $this->fieldLabel($control);
        $groupCss = array_merge(['row'], $group->getCss());

        return '
    <div class="'.implode(' ', $groupCss).'">
        <div class="columns large-12">
            '.$label.'
            '.$this->decorate($control).'
            '.$this->renderErrors($control).'
            '.$this->renderHelp($control).'
        </div>
    </div>
        ';
    }

    /**
     * @param CheckableList $control
     * @param Group $group
     * @return string
     */
    protected function renderCheckableListHorizontal(CheckableList $control, Group $group)
    {
        $label = $this->fieldLabel($control, 'inline right');
        $groupCss = array_merge(['row'], $group->getCss());

        return '
    <div class="'.implode(' ', $groupCss).'">
        <div class="'.$this->getLabelColumnClass($group).'">
            '.$label.'
        </div>
        <div class="'.$this->getFieldColumnClass($group).'">
            '.$this->decorate($control).'
            '.$this->renderErrors($control).'
            '.$this->renderHelp($control).'
        </div>
    </div>
        ';
    }

    /**
     * @param CheckableList $control
     * @param \inkvizytor\FluentForm\Controls\Elements\Group $group
     * @return string
     */
    protected function renderCheckableListInline(CheckableList $control, Group $group)
    {
        $groupCss = array_merge(['left'], $group->getCss());

        return '
    <div class="'.implode(' ', $groupCss).'">
        '.$this->decorate($control).'
        '.$this->renderErrors($control).'
        '.$this->renderHelp($control).'
    </div>
        ';
    }

    // --------------------------------------------------

    /**
     * @param \inkvizytor\FluentForm\Components\ButtonGroup $control
     * @param \inkvizytor\FluentForm\Controls\Elements\Group|null $group
     */
    protected function extendButtonGroup(ButtonGroup $control, Group $group = null)
    {
        if (!$control->hasClass('btn-group'))
        {
            $control->addClass('btn-group');
        }
    }

    // --------------------------------------------------

    /**
     * @param Content $control
     * @param \inkvizytor\FluentForm\Controls\Elements\Group $group
     */
    protected function extendContent(Content $control, Group $group = null)
    {
        if (!$control->hasClass('form-control-static'))
        {
            $control->addClass('form-control-static');
        }
    }

    // --------------------------------------------------

    private $buttonTypes = [
        'primary',
        'secondary',
        'success',
        'alert'
    ];

    /**
     * @param Button $control
     * @param \inkvizytor\FluentForm\Controls\Elements\Group $group
     */
    protected function extendButton(Button $control, Group $group = null)
    {
        if (!$control->hasClass('button'))
        {
            $control->addClass('button');
        }

        if (empty(array_intersect($control->getCss(), $this->buttonTypes)))
        {
            if ($control->getType() == 'submit')
            {
                $control->addClass('primary');
            }
            else
            {
                $control->addClass('secondary');
            }
        }
    }

    /**
     * @param \inkvizytor\FluentForm\Components\LinkButton $control
     * @param Group $group
     */
    protected function extendLinkButton(LinkButton $control, Group $group = null)
    {
        if (!$control->hasClass('button'))
        {
            $control->addClass('button');
        }

        if (empty(array_intersect($control->getCss(), $this->buttonTypes)))
        {
            $control->addClass('secondary');
        }
    }

    // --------------------------------------------------

    /**
     * @param Footer $control
     * @param Group $group
     */
    protected function extendFooter(Footer $control, Group $group = null)
    {
        $control->css(['panel-footer', 'form-footer']);
    }

    // --------------------------------------------------

    /**
     * @param TabStrip $control
     * @param Group $group
     */
    protected function extendTabStrip(TabStrip $control, Group $group = null)
    {
        $control->attr('active', 'active');

        if ($control->getMode() == 'tabs:begin')
        {
            $control->addClass('tabs');

            $control->attr('tabs', ['data-tab' => '']);
            $control->attr('tab', ['class' => 'tab-title']);
            $control->attr('link', []);
            $control->attr('panels', ['class' => 'tabs-content']);
        }

        if ($control->getMode() == 'panel:begin')
        {
            $control->attr('panel', ['class' => 'content']);
        }
    }

    // --------------------------------------------------

    /**
     * @param Panel $control
     * @param Group $group
     */
    protected function extendPanel(Panel $control, Group $group = null)
    {
        if ($control->getMode() == 'panel:begin')
        {
            if (!$control->hasClass('panel'))
            {
                $control->addClass('panel');
            }

            $control->attr('heading', ['class' => 'panel-heading']);
            $control->attr('body', ['class' => 'panel-body']);
        }

        if ($control->getMode() == 'panel:end')
        {
            $control->attr('footer', ['class' => 'panel-footer']);
        }
    }

    // --------------------------------------------------

    /**
     * @param DateTime $control
     * @return string
     */
    protected function decorateDateTime(DateTime $control)
    {
        $decorator = '
<div class="row collapse">
    <div class="columns small-10">%s</div>
    <span class="columns small-2">
        <span class="postfix">
            <i class="fa fa-fw '.($control->withTimeOnly() ? 'fa-clock-oaa' : 'fa-calendar').'"></i>
        </span>
    </span>
</div>';

        return sprintf($decorator, $control->render());
    }

    // --------------------------------------------------

    /**
     * @param InputGroup $control
     * @return string
     */
    protected function decorateInputGroup(InputGroup $control)
    {
        $size = 12;
        
        $prepend = $control->getPrepend();

        if ($prepend !== null)
        {
            $size -= 2;
            
            if ($prepend instanceof Button || $prepend instanceof LinkButton)
            {
                $prepend->addClass('prefix');
            }
            else if ($prepend instanceof Control)
            {
                $prepend = $this->html()->tag('span', ['class' => 'prefix'], $prepend->display());
            }
            else
            {
                $prepend = $this->html()->tag('span', ['class' => 'prefix'], $prepend);
            }

            $prepend = $this->html()->tag('div', ['class' => 'columns small-2'], $prepend); 
        }

        $append = $control->getAppend();

        if ($append !== null)
        {
            $size -= 2;
            
            if ($append instanceof Button || $append instanceof LinkButton)
            {
                $append->addClass('postfix');
            }
            else if ($append instanceof Control)
            {
                $append = $this->html()->tag('span', ['class' => 'postfix'], $append->display());
            }
            else
            {
                $append = $this->html()->tag('span', ['class' => 'postfix'], $append);
            }

            $append = $this->html()->tag('div', ['class' => 'columns small-2'], $append);
        }
        
        $render = $this->html()->tag('div', ['class' => 'columns small-'.$size], $control->render());
        
        return $this->html()->tag('div', ['class' => 'row collapse'], $prepend.$render.$append);
    }

    // --------------------------------------------------

    /**
     * @param Field $control
     * @param string $class
     * @return string
     */
    private function fieldLabel(Field $control, $class = null)
    {
        $attributes = [
            'for' => $control->getName()
        ];

        if ($control->isSrOnly())
        {
            $class = trim($class.' sr-only');
        }

        if (!empty($class))
        {
            $attributes['class'] = $class;
        }

        $label = $control->getLabel();

        if (!empty($label))
        {
            if ($this->isRequired($control))
            {
                $label .= ' '.$this->html()->tag('var', ['class' => 'required'], '*');
            }

            return $this->html()->tag('label', $attributes, $label);
        }

        return null;
    }

    /**
     * @param Group $group
     * @param string $class
     * @return string
     */
    private function groupLabel(Group $group, $class = null)
    {
        $attributes = [];

        if ($group->isSrOnly())
        {
            $class = trim($class.' sr-only');
        }

        if (!empty($class))
        {
            $attributes['class'] = $class;
        }

        $label = $group->getLabel();

        if (!empty($label))
        {
            if ($group->isRequired())
            {
                $label .= ' '.$this->html()->tag('var', ['class' => 'required'], '*');
            }

            return $this->html()->tag('label', $attributes, $label);
        }

        return null;
    }

    /**
     * @param Field $control
     * @return string
     */
    private function hasErrors(Field $control)
    {
        foreach ($this->getErrorMessages($control->getKey()) as $message)
        {
            return true;
        }

        return false;
    }

    /**
     * @param Field $control
     * @return string
     */
    private function renderErrors(Field $control)
    {
        foreach ($this->getErrorMessages($control->getKey()) as $message)
        {
            $name = str_replace('_', ' ', Str::snake($control->getKey()));
            $label = $control->getLabel() ? $control->getLabel() : $control->getPlaceholder();
            $message = str_replace($name, $label, $message);

            // Return only first error
            return $this->html()->tag('small', ['class' => 'error'], $message);
        }

        return '';
    }

    /**
     * @param Field $control
     * @return string
     */
    private function renderHelp(Field $control)
    {
        if (!empty($control->getHelp()))
        {
            return $this->html()->tag('p', [], $control->getHelp());
        }

        return '';
    }

    /**
     * @param array $width
     * @return array
     */
    private function getWidthCss(array $width)
    {
        $css = ['columns'];

        foreach ($width as $key => $size)
        {
            if ($size != null)
            {
                switch ($key)
                {
                    case 'lg':
                        $css['large'] = "large-$size";
                        break;
                    case 'md':
                        $css['medium'] = "medium-$size";
                        break;
                    default:
                        $css['small'] = "small-$size";
                }
            }
        }

        return $css;
    }

    /**
     * @param string $content
     * @param array $width
     * @return string
     */
    private function applyWidth($content, array $width)
    {
        $css = $this->getWidthCss($width);

        if (!empty($css))
        {
            $content = $this->html()->tag('div', ['class' => 'row'],
                $this->html()->tag('div', ['class' => implode(' ', $css)], $content)
            );
        }

        return $content;
    }

    /**
     * @param Group $group
     * @return string
     */
    private function getLabelColumnClass(Group $group)
    {
        $class = [
            'column',
            'large-'.($group->getLabelSize('lg') ?: $this->getLabelSize('lg')),
            'medium-'.($group->getLabelSize('md') ?: $this->getLabelSize('md')),
            'small-'.($group->getLabelSize('sm') ?: $this->getLabelSize('sm'))
        ];

        return implode(' ', $class);
    }

    /**
     * @param Group $group
     * @return string
     */
    private function getFieldColumnClass(Group $group)
    {
        $class = [
            'column',
            'large-'.($group->getFieldSize('lg') ?: $this->getFieldSize('lg')),
            'medium-'.($group->getFieldSize('md') ?: $this->getFieldSize('md')),
            'small-'.($group->getFieldSize('sm') ?: $this->getFieldSize('sm'))
        ];

        return implode(' ', $class);
    }

    /**
     * @param Checkable $control
     * @return string
     */
    private function getCheckableCss(Checkable $control)
    {
        return $control->getType() == 'checkbox' ? 'checkbox' : 'radio';
    }
}