<?php

namespace App\Forms;

/**
 * Form
 *
 * @author Petr Poupě
 */
class Form extends \Nette\Application\UI\Form
{

    /**
     * 
     * @param type $name
     * @param type $caption
     * @return Controls\DateInput
     */
    public function addDateInput($name, $caption = NULL)
    {
        return $this[$name] = new Controls\DateInput($caption);
    }

    /**
     * 
     * @param type $name
     * @param type $caption
     * @return Controls\DatePicker
     */
    public function addDatePicker($name, $caption = NULL)
    {
        return $this[$name] = new Controls\DatePicker($caption);
    }

    /**
     * 
     * @param type $name
     * @param type $caption
     * @param type $rows
     * @return Controls\WysiHtml
     */
    public function addWysiHtml($name, $caption = NULL, $rows = NULL)
    {
        return $this[$name] = new Controls\WysiHtml($caption, $rows);
    }

    /**
     * 
     * @param type $name
     * @param type $caption
     * @param type $onText
     * @param type $offText
     * @return Controls\CheckSwitch
     */
    public function addCheckSwitch($name, $caption = NULL, $onText = NULL, $offText = NULL)
    {
        return $this[$name] = new Controls\CheckSwitch($caption, $onText, $offText);
    }

    /**
     * 
     * @param type $name
     * @param type $caption
     * @return Controls\TouchSpin
     */
    public function addTouchSpin($name, $caption = NULL)
    {
        return $this[$name] = new Controls\TouchSpin($caption);
    }

}