<?php

namespace App\AdminModule\Presenters;

use Nette;
use Tracy\Debugger as Debug;

/**
 * Dashboard presenter.
 */
class DashboardPresenter extends BasePresenter
{

    /** @var \App\Model\Facade\BookFacade @inject */
    public $bookFacade;

    /** @var \App\Model\Facade\AuthorFacade @inject */
    public $authorFacade;

    public function renderDefault()
    {
        $bookFacade = $this->bookFacade;
        $authorFacade = $this->authorFacade;

        $books = $bookFacade->findAll();
        $authors = $authorFacade->findAll();

        $author = $authorFacade->find(1);
//	$author = new \App\Model\Entity\Author;
//	$author->setFirstname("John");
//	$author->setSurname("Doe");
//	$authorFacade->save($author);

        $book = $bookFacade->find(1);
//	$book = new \App\Model\Entity\Book;
//	$book->setAuthor($author);
//	$book->setTitle("Lorem Ipsum");
//	$book->setPublished(new \Nette\Utils\DateTime);
//	$bookFacade->save($book);


        $this->template->books = $books;
        $this->template->count = count($books);

        Debug::barDump($books);
    }

}
