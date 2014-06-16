<?php

namespace App\Forms\Controls;

use Nette;

/**
 * CheckSwitch
 *
 * @author Petr Poupě
 */
class CheckSwitch extends \Nette\Forms\Controls\Checkbox
{

    public function __construct($label = NULL, $onText = NULL, $offText = NULL)
    {
        parent::__construct($label);
        $this->control->class = "make-switch";
        if ($onText) {
            $this->setOnText($onText);
        }
        if ($offText) {
            $this->setOffText($offText);
        }
    }

    public function setOnText($text)
    {
        $attr = "data-on-text";
        $this->control->$attr = $text;
        return $this;
    }

    public function setOffText($text)
    {
        $attr = "data-off-text";
        $this->control->$attr = $text;
        return $this;
    }

    public function setOnColor($color)
    {
        $attr = "data-on-color";
        $this->control->$attr = $color;
        return $this;
    }

    public function setOffColor($color)
    {
        $attr = "data-off-color";
        $this->control->$attr = $color;
        return $this;
    }

    public function setLabelIcon($icon)
    {
        $attr = "data-label-icon";
        $this->control->$attr = $icon;
        return $this;
    }

    /**
     * Generates control's HTML element.
     * @return Nette\Utils\Html
     */
    public function getControl()
    {
        return \Nette\Forms\Controls\BaseControl::getControl()->checked($this->value);
    }

    /**
     * Generates label's HTML element.
     * @param  string
     * @return Nette\Utils\Html
     */
    public function getLabel($caption = NULL)
    {
        return \Nette\Forms\Controls\BaseControl::getLabel($caption);
    }

}
