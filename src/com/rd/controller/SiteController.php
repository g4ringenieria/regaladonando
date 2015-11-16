<?php

namespace com\rd\controller;

use com\rd\view\UserSummaryView;
use NeoPHP\web\http\RedirectResponse;
use NeoPHP\web\WebController;

class SiteController extends WebController
{
    public function onBeforeActionExecution ($action, $params)
    {
        $this->getSession()->start();
        
        $noSessionActions = 
        [
            "showRegistrationForm",
            "registerUser",
            "activateUser",
            "showEvent"
        ];
        
        if (!in_array($action, $noSessionActions))
        {
            if (!isset($this->getSession()->sessionId))
            {
                $redirectResponse = new RedirectResponse("/");
                $redirectResponse->send();
                return false;
            }
        }
        return true;
    }
   
    public function indexAction ()
    {
        return new UserSummaryView();
    }
    
    public function logoutAction ()
    {
        $this->getSession()->destroy();
        return new RedirectResponse("");
    }
}