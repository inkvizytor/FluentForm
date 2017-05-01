<?php namespace inkvizytor\FluentForm\Renderers;

use inkvizytor\FluentForm\Base\Control;
use inkvizytor\FluentForm\Base\Field;
use inkvizytor\FluentForm\Components\Custom\ButtonGroup;
use inkvizytor\FluentForm\Components\Custom\InputGroup;
use inkvizytor\FluentForm\Components\Custom\Panel;
use inkvizytor\FluentForm\Components\Custom\Footer;
use inkvizytor\FluentForm\Controls\Form;
use inkvizytor\FluentForm\Components\Custom\Group;
use inkvizytor\FluentForm\Components\Custom\TabStrip;
use inkvizytor\FluentForm\Controls\Button;
use inkvizytor\FluentForm\Controls\Checkable;
use inkvizytor\FluentForm\Controls\CheckableList;
use inkvizytor\FluentForm\Controls\Content;
use inkvizytor\FluentForm\Controls\Input;
use inkvizytor\FluentForm\Components\Custom\LinkButton;
use inkvizytor\FluentForm\Components\Complex\DateTime;
use Illuminate\Support\Str;

/**
 * Class Bootstrap3
 *
 * @package inkvizytor\FluentForm
 */
class Bootstrap3 extends Base
{
//    /**
//     * @param \inkvizytor\FluentForm\Controls\Form $control
//     * @return string
//     */
//    protected function extendFormStandard(Form $control)
//    {
//        if ($control->getMode() == 'form:open')
//        {
//            $control->addClass('form-standard');
//        }
//    }
//
//    /**
//     * @param \inkvizytor\FluentForm\Controls\Form $control
//     * @return string
//     */
//    protected function extendFormHorizontal(Form $control)
//    {
//        if ($control->getMode() == 'form:open')
//        {
//            $control->addClass('form-horizontal');
//        }
//    }
//
//    /**
//     * @param \inkvizytor\FluentForm\Controls\Form $control
//     * @return string
//     */
//    protected function extendFormInline(Form $control)
//    {
//        if ($control->getMode() == 'form:open')
//        {
//            $control->addClass('form-inline');
//        }
//    }
//
//    // --------------------------------------------------
//
//    /**
//     * @param Field $control
//     * @param Group $group
//     */
//    protected function extendField(Field $control, Group $group = null)
//    {
//        $control->addClass('form-control');
//
//        if ($group != null && $this->hasErrors($control))
//        {
//            $group->addClass('has-error');
//        }
//    }
//
//    /**
//     * @param Field $control
//     * @param \inkvizytor\FluentForm\Components\Custom\Group $group
//     */
//    protected function extendFieldInline(Field $control, Group $group = null)
//    {
//        $this->extendField($control);
//
//        if (!empty($control->getLabel()) && empty($control->getPlaceholder()) && $control->isSrOnly())
//        {
//            $control->placeholder($control->getLabel());
//        }
//    }
//
//    /**
//     * @param Field $control
//     * @param Group $group
//     * @return string
//     */
//    protected function renderFieldStandard(Field $control, Group $group)
//    {
//        $label = $this->fieldLabel($control, 'control-label');
//        $groupCss = array_merge(['form-group'], $group->getCss());
//        $render = $this->decorate($control);
//
//        return '
//    <div class="'.implode(' ', $groupCss).'">
//        '.$label.'
//        '.$this->applyWidth($render, $control->getWidth()).'
//        '.$this->renderErrors($control).'
//        '.$this->renderHelp($control).'
//    </div>
//        ';
//    }
//
//    /**
//     * @param Field $control
//     * @param Group $group
//     * @return string
//     */
//    protected function renderFieldHorizontal(Field $control, Group $group)
//    {
//        $label = $this->fieldLabel($control, $this->getLabelColumnClass($group));
//        $groupCss = array_merge(['form-group'], $group->getCss());
//        $render = $this->decorate($control);
//
//        return '
//    <div class="'.implode(' ', $groupCss).'">
//        '.$label.'
//        <div class="'.$this->getFieldColumnClass($group, empty($label) || $control->isSrOnly()).'">
//            '.$this->applyWidth($render, $control->getWidth()).'
//            '.$this->renderErrors($control).'
//            '.$this->renderHelp($control).'
//        </div>
//    </div>
//        ';
//    }
//
//    /**
//     * @param Field $control
//     * @param \inkvizytor\FluentForm\Components\Custom\Group $group
//     * @return string
//     */
//    protected function renderFieldInline(Field $control, Group $group)
//    {
//        $label = $this->fieldLabel($control);
//        $groupCss = array_merge(['form-group'], $group->getCss());
//        $render = $this->decorate($control);
//
//        return '
//    <div class="'.implode(' ', $groupCss).'">
//        '.$label.'
//        '.$render.'
//        '.$this->renderErrors($control).'
//        '.$this->renderHelp($control).'
//    </div>
//        ';
//    }
//
//    // --------------------------------------------------
//
//    /**
//     * @param Control $control
//     * @param Group $group
//     * @return string
//     */
//    protected function renderGroupStandard(Control $control = null, Group $group)
//    {
//        $label = $this->groupLabel($group, 'control-label');
//        $groupCss = array_merge(['form-group'], $group->getCss());
//        $render = $group->render();
//
//        return '
//    <div class="'.implode(' ', $groupCss).'">
//        '.$label.'
//        '.$render.'
//    </div>
//        ';
//    }
//
//    /**
//     * @param Control $control
//     * @param Group $group
//     * @return string
//     */
//    protected function renderGroupHorizontal(Control $control = null, Group $group)
//    {
//        $label = $this->groupLabel($group, $this->getLabelColumnClass($group));
//        $groupCss = array_merge(['form-group'], $group->getCss());
//        $render = $group->render();
//
//        return '
//    <div class="'.implode(' ', $groupCss).'">
//        '.$label.'
//        <div class="'.$this->getFieldColumnClass($group, empty($label) || $control->isSrOnly()).'">
//            '.$render.'
//        </div>
//    </div>
//        ';
//    }
//
//    /**
//     * @param Control $control
//     * @param \inkvizytor\FluentForm\Components\Custom\Group $group
//     * @return string
//     */
//    protected function renderGroupInline(Control $control = null, Group $group)
//    {
//        $label = $this->groupLabel($group);
//        $groupCss = array_merge(['form-group'], $group->getCss());
//        $render = $group->render();
//
//        return '
//    <div class="'.implode(' ', $groupCss).'">
//        '.$label.'
//        '.$render.'
//    </div>
//        ';
//    }
//
//    // --------------------------------------------------
//
//    /**
//     * @param Input $control
//     * @param Group $group
//     */
//    protected function extendInput(Input $control, Group $group = null)
//    {
//        $this->extendField($control, $group);
//
//        if ($control->getType() == 'file')
//        {
//            $control->removeClass('form-control');
//            $control->addClass('filestyle');
//            $control->data('icon', 'true');
//            $control->data('buttonText', ' ');
//        }
//    }
//
//    // --------------------------------------------------
//
//    /**
//     * @param Checkable $control
//     * @param Group $group
//     */
//    protected function extendCheckable(Checkable $control, Group $group = null)
//    {
//        if ($control->isDisabled() || $control->isReadonly())
//        {
//            if ($group != null)
//            {
//                $group->addClass('disabled');
//            }
//        }
//    }
//
//    /**
//     * @param Checkable $control
//     * @param Group $group
//     * @return string
//     */
//    protected function renderCheckableStandard(Checkable $control, Group $group)
//    {
//        $labelCss = $this->getCheckableCss($control);
//        $groupCss = array_merge([$labelCss], $group->getCss());
//
//        return '
//    <div class="'.implode(' ', $groupCss).'">
//        '.$this->decorate($control).'
//        '.$this->renderErrors($control).'
//        '.$this->renderHelp($control).'
//    </div>
//        ';
//    }
//
//    /**
//     * @param Checkable $control
//     * @param \inkvizytor\FluentForm\Components\Custom\Group $group
//     * @return string
//     */
//    protected function renderCheckableHorizontal(Checkable $control, Group $group)
//    {
//        $label = $this->decorate($control);
//        $labelCss = $this->getCheckableCss($control);
//        $groupCss = array_merge(['form-group'], $group->getCss());
//
//        return '
//    <div class="'.implode(' ', $groupCss).'">
//        <div class="'.$this->getFieldColumnClass($group, true).'">
//            <div class="'.$labelCss.'">'.$label.'</div>
//            '.$this->renderErrors($control).'
//            '.$this->renderHelp($control).'
//        </div>
//    </div>
//        ';
//    }
//
//    /**
//     * @param Checkable $control
//     * @param Group $group
//     * @return string
//     */
//    protected function renderCheckableInline(Checkable $control, Group $group)
//    {
//        $labelCss = $this->getCheckableCss($control);
//        $groupCss = array_merge([$labelCss], $group->getCss());
//
//        return '
//    <div class="'.implode(' ', $groupCss).'">
//        '.$this->decorate($control).'
//        '.$this->renderErrors($control).'
//        '.$this->renderHelp($control).'
//    </div>
//        ';
//    }
//
//    // --------------------------------------------------
//
//    /**
//     * @param CheckableList $control
//     * @param Group $group
//     */
//    protected function extendCheckableList(CheckableList $control, Group $group = null)
//    {
//        if ($control->isInline())
//            $control->addClass('list-inline');
//        else
//            $control->addClass('list-unstyled');
//
//        $control->addClass($control->getType());
//    }
//    
//    /**
//     * @param CheckableList $control
//     * @param Group $group
//     */
//    protected function extendCheckableListInline(CheckableList $control, Group $group = null)
//    {
//        $control->inline(true);
//
//        $this->extendCheckableList($control, $group);
//    }
//
//    /**
//     * @param CheckableList $control
//     * @param Group $group
//     * @return string
//     */
//    protected function renderCheckableListStandard(CheckableList $control, Group $group)
//    {
//        $label = $this->fieldLabel($control, 'control-label');
//        $groupCss = array_merge(['form-group'], $group->getCss());
//
//        return '
//    <div class="'.implode(' ', $groupCss).'">
//        '.$label.'
//        '.$this->decorate($control).'
//        '.$this->renderErrors($control).'
//        '.$this->renderHelp($control).'
//    </div>
//        ';
//    }
//
//    /**
//     * @param CheckableList $control
//     * @param Group $group
//     * @return string
//     */
//    protected function renderCheckableListHorizontal(CheckableList $control, Group $group)
//    {
//        $label = $this->fieldLabel($control, $this->getLabelColumnClass($group));
//        $groupCss = array_merge(['form-group'], $group->getCss());
//
//        return '
//    <div class="'.implode(' ', $groupCss).'">
//        '.$label.'
//        <div class="'.$this->getFieldColumnClass($group, empty($label) || $control->isSrOnly()).'">
//            '.$this->decorate($control).'
//            '.$this->renderErrors($control).'
//            '.$this->renderHelp($control).'
//        </div>
//    </div>
//        ';
//    }
//
//    /**
//     * @param CheckableList $control
//     * @param \inkvizytor\FluentForm\Components\Custom\Group $group
//     * @return string
//     */
//    protected function renderCheckableListInline(CheckableList $control, Group $group)
//    {
//        $label = $this->fieldLabel($control);
//        $groupCss = array_merge(['form-group'], $group->getCss());
//
//        return '
//    <div class="'.implode(' ', $groupCss).'">
//        '.$label.'
//        '.$this->decorate($control).'
//        '.$this->renderErrors($control).'
//        '.$this->renderHelp($control).'
//    </div>
//        ';
//    }
//
//    // --------------------------------------------------
//
//    /**
//     * @param \inkvizytor\FluentForm\Components\Custom\ButtonGroup $control
//     * @param \inkvizytor\FluentForm\Components\Custom\Group|null $group
//     */
//    protected function extendButtonGroup(ButtonGroup $control, Group $group = null)
//    {
//        if (!$control->hasClass('btn-group'))
//        {
//            $control->addClass('btn-group');
//        }
//    }
//
//    // --------------------------------------------------
//
//    /**
//     * @param Content $control
//     * @param \inkvizytor\FluentForm\Components\Custom\Group $group
//     */
//    protected function extendContent(Content $control, Group $group = null)
//    {
//        if (!$control->hasClass('form-control-static'))
//        {
//            $control->addClass('form-control-static');
//        }
//    }
//
//    // --------------------------------------------------
//
//    private $buttonTypes = [
//        'btn-default',
//        'btn-primary',
//        'btn-success',
//        'btn-info',
//        'btn-warning',
//        'btn-danger',
//        'btn-link'
//    ];
//
//    /**
//     * @param Button $control
//     * @param \inkvizytor\FluentForm\Components\Custom\Group $group
//     */
//    protected function extendButton(Button $control, Group $group = null)
//    {
//        if (!$control->hasClass('btn'))
//        {
//            $control->addClass('btn');
//        }
//
//        if (empty(array_intersect($control->getCss(), $this->buttonTypes)))
//        {
//            if ($control->getType() == 'submit')
//            {
//                $control->addClass('btn-primary');
//            }
//            else
//            {
//                $control->addClass('btn-default');
//            }
//        }
//    }
//
//    /**
//     * @param \inkvizytor\FluentForm\Components\Custom\LinkButton $control
//     * @param Group $group
//     */
//    protected function extendLinkButton(LinkButton $control, Group $group = null)
//    {
//        if (!$control->hasClass('btn'))
//        {
//            $control->addClass('btn');
//        }
//
//        if (empty(array_intersect($control->getCss(), $this->buttonTypes)))
//        {
//            $control->addClass('btn-default');
//        }
//    }
//
//    // --------------------------------------------------
//
//    /**
//     * @param Footer $control
//     * @param Group $group
//     */
//    protected function extendFooter(Footer $control, Group $group = null)
//    {
//        $control->css(['panel-footer', 'form-footer']);
//    }
//
//    // --------------------------------------------------
//
//    /**
//     * @param TabStrip $control
//     * @param Group $group
//     */
//    protected function extendTabStrip(TabStrip $control, Group $group = null)
//    {
//        $control->attr('active', 'active');
//
//        if ($control->getMode() == 'tabs:begin')
//        {
//            $control->addClass('nav');
//            $control->addClass($control->isPills() ? 'nav-pills' : 'nav-tabs');
//
//            if ($control->isJustified())
//            {
//                $control->addClass('nav-justified');
//            }
//
//            $control->attr('tabs', ['role' => 'tablist']);
//            $control->attr('tab', ['role' => 'presentation']);
//            $control->attr('link', ['role' => 'tab', 'data-toggle' => 'tab']);
//            $control->attr('panels', ['class' => 'tab-content']);
//        }
//
//        if ($control->getMode() == 'panel:begin')
//        {
//            $control->attr('panel', ['role' => 'tabpanel', 'class' => 'tab-pane']);
//        }
//    }
//
//    // --------------------------------------------------
//
//    private $panelTypes = [
//        'panel-default',
//        'panel-primary',
//        'panel-success',
//        'panel-info',
//        'panel-warning',
//        'panel-danger'
//    ];
//    
//    /**
//     * @param Panel $control
//     * @param Group $group
//     */
//    protected function extendPanel(Panel $control, Group $group = null)
//    {
//        if ($control->getMode() == 'panel:begin')
//        {
//            if (!$control->hasClass('panel'))
//            {
//                $control->addClass('panel');
//            }
//
//            if (empty(array_intersect($control->getCss(), $this->panelTypes)))
//            {
//                $control->addClass('panel-default');
//            }
//            
//            $control->attr('heading', ['class' => 'panel-heading']);
//            $control->attr('body', ['class' => 'panel-body']);
//        }
//
//        if ($control->getMode() == 'panel:end')
//        {
//            $control->attr('footer', ['class' => 'panel-footer']);
//        }
//    }
//
//    // --------------------------------------------------
//
//    /**
//     * @param DateTime $control
//     * @return string
//     */
//    protected function decorateDateTime(DateTime $control)
//    {
//        $decorator = '
//<div class="input-group">
//    %s
//    <span class="input-group-addon">
//        <span class="fa fa-fw fa-calendar"></span>
//    </span>
//</div>';
//
//        return sprintf($decorator, $control->render());
//    }
//
//    // --------------------------------------------------
//
//    /**
//     * @param InputGroup $control
//     * @return string
//     */
//    protected function decorateInputGroup(InputGroup $control)
//    {
//        $prepend = $control->getPrepend();
//        
//        if ($prepend !== null)
//        {
//            if ($prepend instanceof Button || $prepend instanceof LinkButton)
//            {
//                $prepend = $this->html()->tag('span', ['class' => 'input-group-btn'], $prepend->display());
//            }
//            else if ($prepend instanceof Control)
//            {
//                $prepend = $this->html()->tag('span', ['class' => 'input-group-addon'], $prepend->display());
//            }
//            else
//            {
//                $prepend = $this->html()->tag('span', ['class' => 'input-group-addon'], $prepend);
//            }
//        }
//
//        $append = $control->getAppend();
//
//        if ($append !== null)
//        {
//            if ($append instanceof Button || $append instanceof LinkButton)
//            {
//                $append = $this->html()->tag('span', ['class' => 'input-group-btn'], $append->display());
//            }
//            else if ($append instanceof Control)
//            {
//                $append = $this->html()->tag('span', ['class' => 'input-group-addon'], $append->display());
//            }
//            else
//            {
//                $append = $this->html()->tag('span', ['class' => 'input-group-addon'], $append);
//            }
//        }
//        
//        return $this->html()->tag('div', ['class' => 'input-group'], $prepend.$control->render().$append);
//    }
//    
//    // --------------------------------------------------
//
//    /**
//     * @param Field $control
//     * @param string $class
//     * @return string
//     */
//    private function fieldLabel(Field $control, $class = null)
//    {
//        $attributes = [
//            'for' => $control->getName()
//        ];
//
//        if ($control->isSrOnly())
//        {
//            $class = trim($class.' sr-only');
//        }
//
//        if (!empty($class))
//        {
//            $attributes['class'] = $class;
//        }
//
//        $label = $control->getLabel();
//
//        if (!empty($label))
//        {
//            if ($this->isRequired($control))
//            {
//                $label .= ' '.$this->html()->tag('var', ['class' => 'required'], '*');
//            }
//
//            return $this->html()->tag('label', $attributes, $label);
//        }
//
//        return null;
//    }
//
//    /**
//     * @param Group $group
//     * @param string $class
//     * @return string
//     */
//    private function groupLabel(Group $group, $class = null)
//    {
//        $attributes = [];
//
//        if ($group->isSrOnly())
//        {
//            $class = trim($class.' sr-only');
//        }
//
//        if (!empty($class))
//        {
//            $attributes['class'] = $class;
//        }
//
//        $label = $group->getLabel();
//
//        if (!empty($label))
//        {
//            if ($group->isRequired())
//            {
//                $label .= ' '.$this->html()->tag('var', ['class' => 'required'], '*');
//            }
//
//            return $this->html()->tag('label', $attributes, $label);
//        }
//
//        return null;
//    }
//
//    /**
//     * @param Field $control
//     * @return string
//     */
//    private function hasErrors(Field $control)
//    {
//        foreach ($this->getErrorMessages($control->getKey()) as $message)
//        {
//            return true;
//        }
//
//        return false;
//    }
//
//    /**
//     * @param Field $control
//     * @return string
//     */
//    private function renderErrors(Field $control)
//    {
//        foreach ($this->getErrorMessages($control->getKey()) as $message)
//        {
//            $name = str_replace('_', ' ', Str::snake($control->getKey()));
//            $label = $control->getLabel() ? $control->getLabel() : $control->getPlaceholder();
//            $message = str_replace($name, $label, $message);
//
//            // Return only first error
//            return $this->html()->tag('label', ['for' => $control->getKey(), 'class' => 'error'], $message);
//        }
//
//        return '';
//    }
//
//    /**
//     * @param Field $control
//     * @return string
//     */
//    private function renderHelp(Field $control)
//    {
//        if (!empty($control->getHelp()))
//        {
//            return $this->html()->tag('p', ['class' => 'help-block'], $control->getHelp());
//        }
//
//        return '';
//    }
//
//    /**
//     * @param array $width
//     * @return array
//     */
//    private function getWidthCss(array $width)
//    {
//        $css = [];
//
//        foreach ($width as $key => $size)
//        {
//            if ($size != null)
//            {
//                $css[$key] = "col-$key-$size";
//            }
//        }
//
//        return $css;
//    }
//
//    /**
//     * @param string $content
//     * @param array $width
//     * @return string
//     */
//    private function applyWidth($content, array $width)
//    {
//        $css = $this->getWidthCss($width);
//
//        if (!empty($css))
//        {
//            $content = $this->html()->tag(
//                'div', 
//                ['class' => 'row'],
//                $this->html()->tag('div', ['class' => implode(' ', $css)], $content)
//            );
//        }
//
//        return $content;
//    }
//
//    /**
//     * @param Group $group
//     * @return string
//     */
//    private function getLabelColumnClass(Group $group)
//    {
//        $class = [
//            'control-label',
//            'col-lg-'.($group->getLabelSize('lg') ?: $this->getLabelSize('lg')),
//            'col-md-'.($group->getLabelSize('md') ?: $this->getLabelSize('md')),
//            'col-sm-'.($group->getLabelSize('sm') ?: $this->getLabelSize('sm')),
//            'col-xs-'.($group->getLabelSize('xs') ?: $this->getLabelSize('xs'))
//        ];
//
//        return implode(' ', $class);
//    }
//
//    /**
//     * @param Group $group
//     * @param bool $offset
//     * @return string
//     */
//    private function getFieldColumnClass(Group $group, $offset = false)
//    {
//        $class = [
//            'col-lg-'.($group->getFieldSize('lg') ?: $this->getFieldSize('lg')),
//            'col-md-'.($group->getFieldSize('md') ?: $this->getFieldSize('md')),
//            'col-sm-'.($group->getFieldSize('sm') ?: $this->getFieldSize('sm')),
//            'col-xs-'.($group->getFieldSize('xs') ?: $this->getFieldSize('xs'))
//        ];
//
//        if ($offset)
//        {
//            $class = array_merge($class, [
//                'col-lg-offset-'.($group->getLabelSize('lg') ?: $this->getLabelSize('lg')),
//                'col-md-offset-'.($group->getLabelSize('md') ?: $this->getLabelSize('md')),
//                'col-sm-offset-'.($group->getLabelSize('sm') ?: $this->getLabelSize('sm')),
//                'col-xs-offset-'.($group->getLabelSize('xs') ?: $this->getLabelSize('xs'))
//            ]);
//        }
//
//        return implode(' ', $class);
//    }
//
//    /**
//     * @param Checkable $control
//     * @return string
//     */
//    private function getCheckableCss(Checkable $control)
//    {
//        return $control->getType() == 'checkbox' ? 'checkbox' : 'radio';
//    }

    // --------------------------------------------------
    // poniżej nowe obowiązujące metody
    // --------------------------------------------------

    /**
     * @param \inkvizytor\FluentForm\Controls\Form $component
     * @return string
     */
    protected function renderFormStandard(Form $component)
    {
        if ($component->getMode() == 'form:open')
        {
            $component->addClass('form-standard');
        }

        return $component->renderComponent();
    }

    /**
     * @param \inkvizytor\FluentForm\Controls\Form $component
     * @return string
     */
    protected function renderFormHorizontal(Form $component)
    {
        if ($component->getMode() == 'form:open')
        {
            $component->addClass('form-horizontal');
        }

        return $component->renderComponent();
    }

    /**
     * @param \inkvizytor\FluentForm\Controls\Form $component
     * @return string
     */
    protected function renderFormInline(Form $component)
    {
        if ($component->getMode() == 'form:open')
        {
            $component->addClass('form-inline');
        }

        return $component->renderComponent();
    }

    /**
     * @param \inkvizytor\FluentForm\Components\Custom\TabStrip $component
     * @return string
     */
    protected function renderTabStrip(TabStrip $component)
    {
        if ($component->getMode() == TabStrip::TABS_OPEN)
        {
            $component->attr('role', 'tablist');
            $component->addClass('nav');
            $component->addClass($component->isPills() ? 'nav-pills' : 'nav-tabs');

            if ($component->isJustified())
            {
                $component->addClass('nav-justified');
            }

            return $this->html()->tag('div', [], function() use ($component)
            {
                return [
                    $this->html()->tag('ul', array_merge(
                        $component->getAttr(), 
                        $component->getDataAttr(), 
                        $component->getCssAttr()
                    ), function() use ($component)
                    {
                        $tabs = [];
                        
                        foreach ($component->getTabs() as $key => $value)
                        {
                            $tabs[] = $this->html()->tag('li', [
                                'role' => 'presentation',
                                'class' => $component->isActive($key) ? 'active' : null
                            ], [
                                $this->html()->tag('a', [
                                    'href' => "#{$key}",
                                    'data-toggle' => 'tab',
                                    'role' => 'tab',
                                    'aria-controls' => $key
                                ], $value)
                            ]);
                        }
                        
                        return $tabs;
                    }),
                    $this->html()->tag('div', ['class' => 'tab-content'], null, false)
                ];
            }, false);
        }

        if ($component->getMode() == TabStrip::PANEL_BEGIN)
        {
            $component->attr('id', $component->getName());
            $component->attr('role', 'tabpanel');
            $component->addClass('tab-pane');
            
            if ($component->isActive($component->getName()))
            {
                $component->addClass('active');
            }
            
            return $this->html()->tag('div', array_merge(
                $component->getAttr(), 
                $component->getDataAttr(), 
                $component->getCssAttr()
            ), null, false);
        }

        if ($component->getMode() == TabStrip::PANEL_END)
        {
            return $this->html()->close('div');
        }

        if ($component->getMode() == TabStrip::TABS_CLOSE)
        {
            return implode("\n", [
                $this->html()->close('div'),
                $this->html()->close('div'),
            ]);
        }

        return '';
    }
    
    /**
     * @param \inkvizytor\FluentForm\Components\Custom\Panel $component
     * @return string
     */
    protected function renderPanel(Panel $component)
    {
        $panelTypes = [
            'panel-default',
            'panel-primary',
            'panel-success',
            'panel-info',
            'panel-warning',
            'panel-danger'
        ];
        
        if ($component->getMode() == Panel::PANEL_BEGIN)
        {
            if (!$component->hasClass('panel'))
            {
                $component->addClass('panel');
            }

            if (empty(array_intersect($component->getCss(), $panelTypes)))
            {
                $component->addClass('panel-default');
            }
            
            $attributes = array_merge($component->getAttr(), $component->getDataAttr(), $component->getCssAttr());

            $header = '';

            if (!empty($component->getHeading()))
            {
                $header = $this->html()->tag('div', ['class' => 'panel-heading'], $component->getHeading());
            }

            return implode("\n", [
                $this->html()->tag('div', $attributes),
                $header,
                $this->html()->tag('div', ['class' => 'panel-body'])
            ]);
        }

        if ($component->getMode() == Panel::PANEL_END)
        {
            $footer = '';

            if (count($component->getFooter()) > 0)
            {
                $footer = $this->html()->tag('div', ['class' => 'panel-footer'], implode("\n", $component->getFooter()));
            }

            return implode("\n", [
                $this->html()->close('div'),
                $footer,
                $this->html()->close('div')
            ]);
        }

        return '';
    }
}
