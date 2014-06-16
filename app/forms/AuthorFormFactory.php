<?php

namespace App\Forms;

/**
 * AuthorFormFactory
 *
 * @author Petr Poupě
 */
class AuthorFormFactory implements IFormFactory
{

    private $formFactory;

    public function __construct(IFormFactory $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function create()
    {
        $form = $this->formFactory->create();
        $form->addTouchSpin("spin", "Touch Spin")
                ->setPrefix("/")
                ->setPostfix("...")
                ->setButtonUpClass("btn green")
                ->setButtonDownClass("btn red");
        $form->addCheckSwitch("switch", "Switch")
//                ->setOnText("&nbsp;Zapnuto&nbsp;")
                ->setOnText("<i class='fa fa-check'></i>")
//                ->setOffText("&nbsp;Vypnuto&nbsp;")
                ->setOnColor("success")
//                ->setLabelIcon("fa fa-user")
                ->setValue(TRUE);
        $form->addWysiHtml("html", "Html", "5");
        $form->addDatePicker("date", "Date");
        $form->addText('firstname', 'Firstname')
                ->setOption("description", "helper");
        $form->addText('surname', 'Surname');
        
        $form->addSubmit('_submit', 'Save');
        return $form;
    }

}
