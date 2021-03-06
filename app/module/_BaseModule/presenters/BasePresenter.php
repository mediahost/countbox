<?php

namespace App\BaseModule\Presenters;

use Nette;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

    /** @var \Venne\Bridges\Kdyby\DoctrineForms\FormFactoryFactory @inject */
    public $formFactoryFactory;

    /** @var \WebLoader\LoaderFactory @inject */
    public $webLoader;

    /** @var string */
    private $lang;

    protected function startup()
    {
        parent::startup();

        $this->_setPermission();

        $this->_setLang();
    }

    protected function beforeRender()
    {
        parent::beforeRender();
        $this->template->lang = $this->lang;

        $this->_setModuleTemplate();
    }
    
    protected function isAllowed($resource = Nette\Security\IAuthorizator::ALL, $privilege = Nette\Security\IAuthorizator::ALL)
    {
        return $this->getUser()->isAllowed($resource, $privilege);
    }

// <editor-fold defaultstate="collapsed" desc="lang">
    private function _setLang()
    {
        $this->lang = "en";
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="permissions">
    private function _setPermission()
    {
        $this->getUser()->setAuthorizator(new \App\Model\Permission\Permission);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="module template">
    private function _setModuleTemplate()
    {
        $this->template->viewName = $this->view;
        $this->template->root = isset($_SERVER['SCRIPT_FILENAME']) ? realpath(dirname(dirname($_SERVER['SCRIPT_FILENAME']))) : NULL;

        $a = strrpos($this->name, ':');
        if ($a === FALSE) {
            $this->template->moduleName = '';
            $this->template->presenterName = $this->name;
        } else {
            $this->template->moduleName = substr($this->name, 0, $a + 1);
            $this->template->presenterName = substr($this->name, $a + 1);
        }
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="css webloader">

    /** @return CssLoader */
    protected function createComponentCssFront()
    {
        $css = $this->webLoader->createCssLoader('front')
                ->setMedia('screen,projection,tv');
        return $css;
    }

    /** @return CssLoader */
    protected function createComponentCssAdmin()
    {
        $css = $this->webLoader->createCssLoader('admin')
                ->setMedia('screen,projection,tv');
        return $css;
    }

    /** @return CssLoader */
    protected function createComponentCssMetronicCore()
    {
        $css = $this->webLoader->createCssLoader('metronicCore')
                ->setMedia('screen,projection,tv');
        return $css;
    }

    /** @return CssLoader */
    protected function createComponentCssMetronicPlugin()
    {
        $css = $this->webLoader->createCssLoader('metronicPlugin')
                ->setMedia('screen,projection,tv');
        return $css;
    }

    /** @return CssLoader */
    protected function createComponentCssMetronicTheme()
    {
        $css = $this->webLoader->createCssLoader('metronicTheme')
                ->setMedia('screen,projection,tv');
        return $css;
    }

    /** @return CssLoader */
    protected function createComponentCssPrint()
    {
        $css = $this->webLoader->createCssLoader('print')
                ->setMedia('print');
        return $css;
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="js webloader">

    /** @return JavaScriptLoader */
    protected function createComponentJsApp()
    {
        return $this->webLoader->createJavaScriptLoader('app');
    }

    /** @return JavaScriptLoader */
    protected function createComponentJsAppPlugins()
    {
        return $this->webLoader->createJavaScriptLoader('appPlugins');
    }

    /** @return JavaScriptLoader */
    protected function createComponentJsMetronicPlugins()
    {
        return $this->webLoader->createJavaScriptLoader('metronicPlugins');
    }

    /** @return JavaScriptLoader */
    protected function createComponentJsMetronicCore()
    {
        return $this->webLoader->createJavaScriptLoader('metronicCore');
    }

    /** @return JavaScriptLoader */
    protected function createComponentJsMetronicCoreIE9()
    {
        return $this->webLoader->createJavaScriptLoader('metronicCoreIE9');
    }

// </editor-fold>
}
