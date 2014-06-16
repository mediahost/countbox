<?php

namespace App\Forms\Controls;

use Nette\Forms\Controls\BaseControl;
use Nette\Utils\Html;

/**
 * DatePicker
 *
 * @author Petr Poupě
 */
class DatePicker extends BaseControl
{

    const SIZE_FLUID = NULL;
    const SIZE_XL = "input-xlarge";
    const SIZE_L = "input-large";
    const SIZE_M = "input-medium";
    const SIZE_S = "input-small";
    const SIZE_XS = "input-xsmall";

    private $date;
    private $format;
    private $size;
    private $readOnly = FALSE;
    private $attributes = array();

    public function __construct($label = NULL, $format = "d.m.Y")
    {
        parent::__construct($label);
        $this->format = $format;
        $this->attributes["data-date-format"] = \App\Helpers::dateformatPHP2JS($this->format);
        $this->addRule(__CLASS__ . '::validateDate', 'Date is invalid.');
    }

    /**
     * @return bool
     */
    public static function validateDate(\Nette\Forms\IControl $control)
    {
        if (!$control->isRequired() && empty($control->date)) {
            return TRUE;
        } else {
            $d = \Nette\DateTime::createFromFormat($control->format, $control->date);
            return $d && $d->format($control->format) == $control->date;
        }
    }

    public function setValue($value)
    {
        if ($value) {
            $this->date = \Nette\DateTime::from($value);
        } else {
            $this->date = NULL;
        }
    }

    /**
     * @return DateTime|NULL
     */
    public function getValue()
    {
        return self::validateDate($this) ? \Nette\DateTime::createFromFormat($this->format, $this->date) : NULL;
    }

    public function loadHttpData()
    {
        $this->date = $this->getHttpData(\Nette\Forms\Form::DATA_LINE, '[date]');
    }

    /**
     * Generates control's HTML element.
     */
    public function getControl()
    {
        $input = $this->getInput(!$this->readOnly);
        $icon = $this->getIcon();
        $button = $this->getButton();

        $block = Html::el('div');
        $block->class($this->size, TRUE);
        if ($this->readOnly) {
            $block->class('input-group date date-picker', TRUE)
                    ->addAttributes($this->attributes)
                    ->add($input)
                    ->add($button);
        } else {
            $block->class('input-icon right', TRUE)
                    ->add($icon)
                    ->add($input->addAttributes($this->attributes));
        }
        return $block;
    }

    public function setSize($size = self::SIZE_FLUID)
    {
        switch ($size) {
            case self::SIZE_FLUID:
            case self::SIZE_XL:
            case self::SIZE_L:
            case self::SIZE_M:
            case self::SIZE_S:
            case self::SIZE_XS:
                $this->size = $size;
                break;
            default:
                $this->size = self::SIZE_FLUID;
                break;
        }
        return $this;
    }

    public function setReadOnly($value = TRUE)
    {
        $this->readOnly = $value;
        return $this;
    }

    private function getInput($picker = TRUE)
    {
        $input = Html::el('input class="form-control"')
                ->name($this->getHtmlName() . '[date]')
                ->id($this->getHtmlId())
                ->value(self::validateDate($this) ? $this->date : NULL);
        if ($picker) {
            $input->class("date-picker", TRUE);
        }
        if ($this->readOnly) {
            $input->readonly("readonly");
        }
        return $input;
    }

    private function getIcon()
    {
        return Html::el('i class="fa fa-calendar"');
    }

    private function getButton()
    {
        return Html::el('span class="input-group-btn"')
                        ->add(Html::el('button class="btn default" type="button"')
                                ->add($this->getIcon()));
    }

}
