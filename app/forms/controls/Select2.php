<?php

namespace App\Forms\Controls;

/**
 * Select2
 *
 * @author Petr Poupě
 */
class Select2 extends \Nette\Forms\Controls\SelectBox
{

    public function __construct($label = NULL, array $items = NULL)
    {
        parent::__construct($label, $items);
        $this->control->class = "select2";
    }

}
