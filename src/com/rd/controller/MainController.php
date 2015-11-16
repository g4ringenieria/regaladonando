<?php

namespace com\rd\controller;

use com\rd\view\PortalView;
use NeoPHP\web\WebController;

class MainController extends WebController
{
    public function onBeforeActionExecution ($action, $params)
    {
        $this->getSession()->destroy();
        return true;
    }
   
    public function indexAction ()
    {
        return new PortalView();
    }
}

?>