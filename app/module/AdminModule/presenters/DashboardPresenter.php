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

    /** @var \App\Forms\AuthorFormFactory @inject */
    public $authorFormFactory;
    
    /** @var \Venne\Bridges\Kdyby\DoctrineForms\FormFactoryFactory @inject */
    public $formFactoryFactory;
    
    /** @var App\Model\Entity\Author */
    private $author;

    public function actionDefault()
    {
        $bookFacade = $this->bookFacade;
        $authorFacade = $this->authorFacade;

        $books = $bookFacade->findAll();
        $authors = $authorFacade->findAll();

        $this->author = $authorFacade->find(1);
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

//        Debug::barDump($books);
    }

// <editor-fold defaultstate="collapsed" desc="Forms">

    public function createComponentAuthorForm()
    {
        $form = $this->formFactoryFactory
                ->create($this->authorFormFactory)
                ->setEntity($this->author)
                ->create();
        $form->onSuccess[] = $this->authorFormSuccess;
        return $form;
    }

    public function authorFormSuccess($form)
    {
        $em = $this->formFactoryFactory->getEntityMapper();
        $em->save($this->author, $form);
        $em->load($this->author, $form);
    }

// </editor-fold>
}