<?php

namespace App\AdminModule\Presenters;

use Nette;

/**
 * Dashboard presenter.
 */
class DashboardPresenter extends BasePresenter
{

    /** @var \App\Model\Facade\BookFacade @inject */
    public $bookFacade;

    public function renderDefault()
    {
        $books = $this->bookFacade->findAll();

        $this->template->books = $books;
        $this->template->count = count($books);
	
	\Tracy\Debugger::barDump($books);
    }
    
}
