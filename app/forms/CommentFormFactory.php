<?php

namespace App\Forms;

/**
 * CommentFormFactory
 *
 * @author Petr Poupě
 */
class CommentFormFactory extends FormFactory
{

    public function create()
    {
        $form = $this->formFactory->create();
        $form->addTextArea('message', 'Message', NULL, 4)
                ->setAttribute("placeholder", "Type a message here...");
        
        $form->addSubmit('sendPrivate', 'Private');
        $form->addSubmit('sendPublic', 'Public');
        return $form;
    }

}
