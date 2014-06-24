<?php

namespace App\AdminModule\Presenters;

use Nette;
use Tracy\Debugger as Debug;

/**
 * Companies presenter.
 */
class CompaniesPresenter extends BasePresenter
{

    /** @var \App\Model\Facade\CompanyFacade @inject */
    public $companyFacade;

    /** @var array */
    public $companies;

    /** @var \App\Forms\CompanyFormFactory @inject */
    public $companyFormFactory;

    /** @var \App\Model\Entity\Company */
    private $company;

    protected function startup()
    {
        parent::startup();
        $this->isAllowed("companies", "view");
    }

    public function actionDefault()
    {
        $this->companies = $this->companyFacade->findAll();
    }

    public function renderDefault()
    {
        $this->template->companies = $this->companies;
    }

    public function actionAdd()
    {
        $this->company = new \App\Model\Entity\Company;
        $this->companyFormFactory->setAdding();
        $this->setView("edit");
    }

    public function actionEdit($id)
    {
        $this->company = $this->companyFacade->find($id);
    }

    public function renderEdit()
    {
        $this->template->isAdd = $this->companyFormFactory->isAdding();
    }

    public function actionDelete($id)
    {
        $this->flashMessage("Not implemented yet.", 'warning');
        $this->redirect("default");
    }

// <editor-fold defaultstate="collapsed" desc="Forms">

    public function createComponentCompanyForm()
    {
        $form = $this->formFactoryFactory
                ->create($this->companyFormFactory)
                ->setEntity($this->company)
                ->create();
        $form->onSuccess[] = $this->companyFormSuccess;
        return $form;
    }

    public function companyFormSuccess($form)
    {
        $this->formFactoryFactory
                ->getEntityMapper()
                ->save($this->company, $form);        
        $this->companyFacade->save($this->company);

        if ($form['_submitContinue']->submittedBy) {
            $this->redirect("edit", $this->company->getId());
        }
        $this->redirect("Companies:");
    }

// </editor-fold>
}
