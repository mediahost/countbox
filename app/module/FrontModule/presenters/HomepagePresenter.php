<?php

namespace App\FrontModule\Presenters;

use Nette;
use Tracy\Debugger as Debug;

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

    /** @var \App\Model\Facade\RoleFacade @inject */
    public $roleFacade;

    /** @var \App\Model\Facade\UserFacade @inject */
    public $userFacade;

    public function actionDefault()
    {
//        $this->roleFacade->create("programmer");
//        $this->roleFacade->create("manager");
//        $this->roleFacade->create("client");
        
        $role1 = $this->roleFacade->findByName("programmer");
        $role2 = $this->roleFacade->findByName("manager");
        $role3 = $this->roleFacade->findByName("client");
        
//        $user = $this->userFacade->create("pupe.dupe@gmail.com", "pto");
//        $user = $this->userFacade->findByUsername("pupe.dupe@gmail.com");
//        $user->addRole($role1);
//        $this->userFacade->save($user);
        
        
//        Debug::barDump($user);
//        Debug::barDump($user->toArray());
    }

}
