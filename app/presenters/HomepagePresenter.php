<?php

namespace App\Presenters;

use Nette;

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{
// <editor-fold defaultstate="collapsed" desc="webloader">

    /** @return CssLoader */
    protected function createComponentCssFront()
    {
	$css = $this->webLoader->createCssLoader('front')
		->setMedia('screen,projection,tv')
		->setType(null);
	return $css;
    }

    /** @return CssLoader */
    protected function createComponentCssPrint()
    {
	$css = $this->webLoader->createCssLoader('print')
		->setMedia('print')
		->setType(null);
	return $css;
    }

    /** @return JavaScriptLoader */
    protected function createComponentJs()
    {
	return $this->webLoader->createJavaScriptLoader('default');
    }

// </editor-fold>
}
