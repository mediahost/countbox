<?php

namespace App\Forms\Controls;

/**
 * TouchSpin
 *
 * @author Petr Poupě
 */
class TouchSpin extends \Nette\Forms\Controls\TextInput
{

    public function __construct($label = NULL)
    {
        parent::__construct($label);
        $this->control->class = "touchspin";
    }

    public function setPrefix($value)
    {
        $attr = "data-prefix";
        $this->control->$attr = $value;
        return $this;
    }

    public function setPostfix($value)
    {
        $attr = "data-postfix";
        $this->control->$attr = $value;
        return $this;
    }

    public function setButtonDownClass($value)
    {
        $attr = "data-buttondown-class";
        $this->control->$attr = $value;
        return $this;
    }

    public function setButtonUpClass($value)
    {
        $attr = "data-buttonup-class";
        $this->control->$attr = $value;
        return $this;
    }

    public function setMin($value)
    {
        $attr = "data-min";
        $this->control->$attr = $value;
        return $this;
    }

    public function setMax($value)
    {
        $attr = "data-max";
        $this->control->$attr = $value;
        return $this;
    }

    public function setStepInterval($value)
    {
        $attr = "data-stepinterval";
        $this->control->$attr = $value;
        return $this;
    }

    public function setDecimals($value)
    {
        $attr = "data-decimals";
        $this->control->$attr = $value;
        return $this;
    }

    public function setBoostat($value)
    {
        $attr = "data-boostat";
        $this->control->$attr = $value;
        return $this;
    }

    public function setMaxBoostedStep($value)
    {
        $attr = "data-maxboostedstep";
        $this->control->$attr = $value;
        return $this;
    }

}
