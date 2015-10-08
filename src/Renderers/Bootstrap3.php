<?php namespace inkvizytor\FluentForm\Renderers;

use inkvizytor\FluentForm\Base\Control;
use inkvizytor\FluentForm\Base\Fluent;
use inkvizytor\FluentForm\Containers\ButtonGroup;
use inkvizytor\FluentForm\Containers\FormFooter;
use inkvizytor\FluentForm\Containers\Form;
use inkvizytor\FluentForm\Containers\FormGroup;
use inkvizytor\FluentForm\Containers\TabStrip;
use inkvizytor\FluentForm\Controls\Button;
use inkvizytor\FluentForm\Controls\Checkable;
use inkvizytor\FluentForm\Controls\CheckableList;
use inkvizytor\FluentForm\Controls\Field;
use inkvizytor\FluentForm\Controls\Input;
use inkvizytor\FluentForm\Controls\LinkButton;
use inkvizytor\FluentForm\Controls\Special\DateTime;
use inkvizytor\FluentForm\Controls\Special\Editor;
use Illuminate\Support\Str;

class Bootstrap3 extends Base
{
    /**
     * @param Form $control
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
     * @param Form $control
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
     * @param Form $control
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
     * @param Fluent $control
     * @param FormGroup $group
     */
    protected function extendControl(Fluent $control, FormGroup $group = null)
    {
        $control->addClass('form-control');
        
        if ($group != null && $this->hasErrors($control))
        {
            $group->addClass('has-error');
        }
    }

    /**
     * @param Fluent $control
     * @param FormGroup $group
     */
    protected function extendControlInline(Fluent $control, FormGroup $group = null)
    {
        $this->extendControl($control);

        if (!empty($control->getLabel()))
        {
            $control->placeholder($control->getLabel());
        }
    }
    
    /**
     * @param Fluent $control
     * @param FormGroup $group
     * @return string
     */
    protected function renderControlStandard(Fluent $control, FormGroup $group)
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
     * @param Fluent $control
     * @param FormGroup $group
     * @return string
     */
    protected function renderControlHorizontal(Fluent $control, FormGroup $group)
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
     * @param Fluent $control
     * @param FormGroup $group
     * @return string
     */
    protected function renderControlInline(Fluent $control, FormGroup $group)
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
     * @param FormGroup $group
     * @return string
     */
    protected function renderGroupStandard(Control $control = null, FormGroup $group)
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
     * @param FormGroup $group
     * @return string
     */
    protected function renderGroupHorizontal(Control $control = null, FormGroup $group)
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
     * @param FormGroup $group
     * @return string
     */
    protected function renderGroupInline(Control $control = null, FormGroup $group)
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
     * @param FormGroup $group
     */
    protected function extendInput(Input $control, FormGroup $group = null)
    {
        $this->extendControl($control, $group);
        
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
     * @param FormGroup $group
     */
    protected function extendCheckable(Checkable $control, FormGroup $group = null)
    {
        if ($control->isDisabled() || $control->isReadonly())
        {
            if ($group != null)
                $group->addClass('disabled');
        }
    }
    
    /**
     * @param Checkable $control
     * @param FormGroup $group
     * @return string
     */
    protected function renderCheckableStandard(Checkable $control, FormGroup $group)
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
     * @param FormGroup $group
     * @return string
     */
    protected function renderCheckableHorizontal(Checkable $control, FormGroup $group)
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
     * @param FormGroup $group
     * @return string
     */
    protected function renderCheckableInline(Checkable $control, FormGroup $group)
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
     * @param FormGroup $group
     */
    protected function extendCheckableListInline(CheckableList $control, FormGroup $group = null)
    {
        $control->inline(true);
    }
    
    /**
     * @param CheckableList $control
     * @param FormGroup $group
     * @return string
     */
    protected function renderCheckableListStandard(CheckableList $control, FormGroup $group)
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
     * @param FormGroup $group
     * @return string
     */
    protected function renderCheckableListHorizontal(CheckableList $control, FormGroup $group)
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
     * @param FormGroup $group
     * @return string
     */
    protected function renderCheckableListInline(CheckableList $control, FormGroup $group)
    {
        $label = $this->label($control);
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

    // --------------------------------------------------

    /**
     * @param ButtonGroup $control
     * @param FormGroup $group
     */
    protected function extendButtonGroup(ButtonGroup $control, FormGroup $group = null)
    {
        if (!$control->hasClass('btn-group'))
        {
            $control->addClass('btn-group');
        }
    }

    // --------------------------------------------------

    /**
     * @param Field $control
     * @param FormGroup $group
     */
    protected function extendField(Field $control, FormGroup $group = null)
    {
        if (!$control->hasClass('form-control-static'))
        {
            $control->addClass('form-control-static');
        }
    }

    // --------------------------------------------------

    private $buttonTypes = ['btn-default', 'btn-primary', 'btn-success', 'btn-info', 'btn-warning', 'btn-danger', 'btn-link'];

    /**
     * @param Button $control
     * @param FormGroup $group
     */
    protected function extendButton(Button $control, FormGroup $group = null)
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
     * @param LinkButton $control
     * @param FormGroup $group
     */
    protected function extendLinkButton(LinkButton $control, FormGroup $group = null)
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
     * @param FormFooter $control
     * @param FormGroup $group
     */
    protected function extendFormFooter(FormFooter $control, FormGroup $group = null)
    {
        $control->css(['panel-footer', 'form-footer']);
    }

    // --------------------------------------------------

    /**
     * @param TabStrip $control
     * @param FormGroup $group
     */
    protected function extendTabStrip(TabStrip $control, FormGroup $group = null)
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
     * @param FormGroup $group
     */
    protected function extendDateTime(DateTime $control, FormGroup $group = null)
    {
        $this->extendControl($control);
        
        $control->data('toggle', $control->withTime() ? 'datetime' : 'date');
    }

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
     * @param Editor $control
     * @param FormGroup $group
     */
    protected function extendEditor(Editor $control, FormGroup $group = null)
    {
        $this->extendControl($control, $group);
        
        $control->attr('id', $control->getName());
        $control->attr('rows', 20);
        $control->data('editor', $control->getName());
    }

    /**
     * @param Editor $control
     * @param FormGroup $group
     */
    protected function extendEditorInline(Editor $control, FormGroup $group = null)
    {
        $this->extendControlInline($control, $group);
        
        $control->attr('id', $control->getName());
        $control->attr('rows', 20);
        $control->data('editor', $control->getName());
    }
    
    // --------------------------------------------------

    /**
     * @param Fluent $control
     * @param string $class
     * @return string
     */
    private function label(Fluent $control, $class = null)
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
            
            return '<label'.$this->html()->attr($attributes).'>'.$label.'</label>';
        }
        
        return null;
    }

    /**
     * @param Fluent $control
     * @return string
     */
    private function hasErrors(Fluent $control)
    {
        foreach ($this->getErrorMessages($control->getName()) as $message)
        {
            return true;
        }

        return false;
    }

    /**
     * @param Fluent $control
     * @return string
     */
    private function renderErrors(Fluent $control)
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
     * @param Fluent $control
     * @return string
     */
    private function renderHelp(Fluent $control)
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
     * @param FormGroup $group
     * @return string
     */
    private function getLabelColumnClass(FormGroup $group)
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
     * @param FormGroup $group
     * @param bool $offset
     * @return string
     */
    private function getFieldColumnClass(FormGroup $group, $offset = false)
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