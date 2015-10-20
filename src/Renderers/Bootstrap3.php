<?php namespace inkvizytor\FluentForm\Renderers;

use inkvizytor\FluentForm\Base\Control;
use inkvizytor\FluentForm\Base\Field;
use inkvizytor\FluentForm\Components\ButtonGroup;
use inkvizytor\FluentForm\Components\InputGroup;
use inkvizytor\FluentForm\Controls\Elements\Footer;
use inkvizytor\FluentForm\Controls\Elements\Form;
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

class Bootstrap3 extends Base
{
    /**
     * @param \inkvizytor\FluentForm\Controls\Elements\Form $control
     * @return string
     */
    protected function extendFormStandard(Form $control)
    {
        if ($control->getMode() == 'form:open')
        {
            $control->addClass('form-standard');
        }
    }

    /**
     * @param \inkvizytor\FluentForm\Controls\Elements\Form $control
     * @return string
     */
    protected function extendFormHorizontal(Form $control)
    {
        if ($control->getMode() == 'form:open')
        {
            $control->addClass('form-horizontal');
        }
    }

    /**
     * @param \inkvizytor\FluentForm\Controls\Elements\Form $control
     * @return string
     */
    protected function extendFormInline(Form $control)
    {
        if ($control->getMode() == 'form:open')
        {
            $control->addClass('form-inline');
        }
    }

    // --------------------------------------------------

    /**
     * @param Field $control
     * @param Group $group
     */
    protected function extendField(Field $control, Group $group = null)
    {
        $control->addClass('form-control');

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

        if (!empty($control->getLabel()))
        {
            $control->placeholder($control->getLabel());
        }
    }

    /**
     * @param Field $control
     * @param Group $group
     * @return string
     */
    protected function renderFieldStandard(Field $control, Group $group)
    {
        $label = $this->label($control, 'control-label');
        $groupCss = array_merge(['form-group'], $group->getCss());
        $render = $this->decorate($control);

        return '
    <div class="'.implode(' ', $groupCss).'">
        '.$label.'
        '.$this->applyWidth($render, $control->getWidth()).'
        '.$this->renderHelp($control).'
        '.$this->renderErrors($control).'
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
        $label = $this->label($control, $this->getLabelColumnClass($group));
        $groupCss = array_merge(['form-group'], $group->getCss());
        $render = $this->decorate($control);

        return '
    <div class="'.implode(' ', $groupCss).'">
        '.$label.'
        <div class="'.$this->getFieldColumnClass($group, empty($label)).'">
            '.$this->applyWidth($render, $control->getWidth()).'
            '.$this->renderHelp($control).'
            '.$this->renderErrors($control).'
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
        $label = $this->label($control);
        $groupCss = array_merge(['form-group'], $group->getCss());
        $render = $this->decorate($control);

        return '
    <div class="'.implode(' ', $groupCss).'">
        '.$label.'
        '.$render.'
        '.$this->renderHelp($control).'
        '.$this->renderErrors($control).'
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
        $groupCss = array_merge(['form-group'], $group->getCss());

        return '
    <div class="'.implode(' ', $groupCss).'">
        '.$group->render().'
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
        $groupCss = array_merge(['form-group'], $group->getCss());

        return '
    <div class="'.implode(' ', $groupCss).'">
        <div class="'.$this->getFieldColumnClass($group, true).'">
            '.$group->render().'
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
        $groupCss = array_merge(['form-group'], $group->getCss());

        return '
    <div class="'.implode(' ', $groupCss).'">
        '.$group->render().'
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
        $groupCss = array_merge([$labelCss], $group->getCss());

        return '
    <div class="'.implode(' ', $groupCss).'">
        '.$this->decorate($control).'
        '.$this->renderHelp($control).'
        '.$this->renderErrors($control).'
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
        $groupCss = array_merge(['form-group'], $group->getCss());

        return '
    <div class="'.implode(' ', $groupCss).'">
        <div class="'.$this->getFieldColumnClass($group, true).'">
            <div class="'.$labelCss.'">'.$label.'</div>
            '.$this->renderHelp($control).'
            '.$this->renderErrors($control).'
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
        $groupCss = array_merge([$labelCss], $group->getCss());

        return '
    <div class="'.implode(' ', $groupCss).'">
        '.$this->decorate($control).'
        '.$this->renderHelp($control).'
        '.$this->renderErrors($control).'
    </div>
        ';
    }

    // --------------------------------------------------

    /**
     * @param CheckableList $control
     * @param Group $group
     */
    protected function extendCheckableListInline(CheckableList $control, Group $group = null)
    {
        $control->inline(true);
    }

    /**
     * @param CheckableList $control
     * @param Group $group
     * @return string
     */
    protected function renderCheckableListStandard(CheckableList $control, Group $group)
    {
        $label = $this->label($control, 'control-label');
        $groupCss = array_merge(['form-group'], $group->getCss());

        return '
    <div class="'.implode(' ', $groupCss).'">
        '.$label.'
        <div class="'.$control->getType().'">
            '.$this->decorate($control).'
        </div>
        '.$this->renderHelp($control).'
        '.$this->renderErrors($control).'
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
        $label = $this->label($control, $this->getLabelColumnClass($group));
        $groupCss = array_merge(['form-group'], $group->getCss());

        return '
    <div class="'.implode(' ', $groupCss).'">
        '.$label.'
        <div class="'.$this->getFieldColumnClass($group, empty($label)).'">
            <div class="'.$control->getType().'">
                '.$this->decorate($control).'
            </div>
            '.$this->renderHelp($control).'
            '.$this->renderErrors($control).'
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
        $label = $this->label($control);
        $groupCss = array_merge(['form-group'], $group->getCss());

        return '
    <div class="'.implode(' ', $groupCss).'">
        '.$label.'
        <div class="form-control-static '.$control->getType().'">
            '.$this->decorate($control).'
        </div>
        '.$this->renderHelp($control).'
        '.$this->renderErrors($control).'
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
        'btn-default',
        'btn-primary',
        'btn-success',
        'btn-info',
        'btn-warning',
        'btn-danger',
        'btn-link'
    ];

    /**
     * @param Button $control
     * @param \inkvizytor\FluentForm\Controls\Elements\Group $group
     */
    protected function extendButton(Button $control, Group $group = null)
    {
        if (!$control->hasClass('btn'))
        {
            $control->addClass('btn');
        }

        if (empty(array_intersect($control->getCss(), $this->buttonTypes)))
        {
            if ($control->getType() == 'submit')
            {
                $control->addClass('btn-primary');
            }
            else
            {
                $control->addClass('btn-default');
            }
        }
    }

    /**
     * @param \inkvizytor\FluentForm\Components\LinkButton $control
     * @param Group $group
     */
    protected function extendLinkButton(LinkButton $control, Group $group = null)
    {
        if (!$control->hasClass('btn'))
        {
            $control->addClass('btn');
        }

        if (empty(array_intersect($control->getCss(), $this->buttonTypes)))
        {
            $control->addClass('btn-default');
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
            $control->addClass('nav');
            $control->addClass($control->isPills() ? 'nav-pills' : 'nav-tabs');

            if ($control->isJustified())
            {
                $control->addClass('nav-justified');
            }

            $control->attr('tabs', ['role' => 'tablist']);
            $control->attr('tab', ['role' => 'presentation']);
            $control->attr('link', ['role' => 'tab', 'data-toggle' => 'tab']);
            $control->attr('panels', ['class' => 'tab-content']);
        }

        if ($control->getMode() == 'panel:begin')
        {
            $control->attr('panel', ['role' => 'tabpanel', 'class' => 'tab-pane']);
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
<div class="input-group">
    %s
    <span class="input-group-addon">
        <span class="fa fa-fw fa-calendar"></span>
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
        $prepend = $control->getPrepend();
        
        if ($prepend !== null)
        {
            if ($prepend instanceof Button || $prepend instanceof LinkButton)
            {
                $prepend = sprintf('<span class="input-group-btn">%s</span>', $prepend->display());
            }
            else if ($prepend instanceof Control)
            {
                $prepend = sprintf('<span class="input-group-addon">%s</span>', $prepend->display());
            }
            else
            {
                $prepend = sprintf('<span class="input-group-addon">%s</span>', $prepend);
            }
        }

        $append = $control->getAppend();

        if ($append !== null)
        {
            if ($append instanceof Button || $append instanceof LinkButton)
            {
                $append = sprintf('<span class="input-group-btn">%s</span>', $append->display());
            }
            else if ($append instanceof Control)
            {
                $append = sprintf('<span class="input-group-addon">%s</span>', $append->display());
            }
            else
            {
                $append = sprintf('<span class="input-group-addon">%s</span>', $append);
            }
        }
        
        $decorator = '
<div class="input-group">
    '.$prepend.'
    %s
    '.$append.'
</div>';

        return sprintf($decorator, $control->render());
    }
    
    // --------------------------------------------------

    /**
     * @param Field $control
     * @param string $class
     * @return string
     */
    private function label(Field $control, $class = null)
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
                $label .= ' <var class="required">*</var>';
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
        foreach ($this->getErrorMessages($control->getName()) as $message)
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
        foreach ($this->getErrorMessages($control->getName()) as $message)
        {
            $name = str_replace('_', ' ', Str::snake($control->getName()));
            $label = $control->getLabel() ? $control->getLabel() : $control->getPlaceholder();
            $message = str_replace($name, $label, $message);

            // Return only first error
            return sprintf('<label class="error" for="%s">%s</label>', $control->getName(), $message);
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
            return sprintf('<p class="help-block">%s</p>', $control->getHelp());
        }

        return '';
    }

    /**
     * @param array $width
     * @return array
     */
    private function getWidthCss(array $width)
    {
        $css = [];

        foreach ($width as $key => $size)
        {
            if ($size != null)
            {
                $css[$key] = "col-$key-$size";
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
            $content = '<div class="row"><div class="'.implode(' ', $css).'">'.$content.'</div></div>';
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
            'control-label',
            'col-lg-'.($group->getLabelSize('lg') ?: $this->getLabelSize('lg')),
            'col-md-'.($group->getLabelSize('md') ?: $this->getLabelSize('md')),
            'col-sm-'.($group->getLabelSize('sm') ?: $this->getLabelSize('sm')),
            'col-xs-'.($group->getLabelSize('xs') ?: $this->getLabelSize('xs'))
        ];

        return implode(' ', $class);
    }

    /**
     * @param Group $group
     * @param bool $offset
     * @return string
     */
    private function getFieldColumnClass(Group $group, $offset = false)
    {
        $class = [
            'col-lg-'.($group->getFieldSize('lg') ?: $this->getFieldSize('lg')),
            'col-md-'.($group->getFieldSize('md') ?: $this->getFieldSize('md')),
            'col-sm-'.($group->getFieldSize('sm') ?: $this->getFieldSize('sm')),
            'col-xs-'.($group->getFieldSize('xs') ?: $this->getFieldSize('xs'))
        ];

        if ($offset)
        {
            $class = array_merge($class, [
                'col-lg-offset-'.($group->getLabelSize('lg') ?: $this->getLabelSize('lg')),
                'col-md-offset-'.($group->getLabelSize('md') ?: $this->getLabelSize('md')),
                'col-sm-offset-'.($group->getLabelSize('sm') ?: $this->getLabelSize('sm')),
                'col-xs-offset-'.($group->getLabelSize('xs') ?: $this->getLabelSize('xs'))
            ]);
        }

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