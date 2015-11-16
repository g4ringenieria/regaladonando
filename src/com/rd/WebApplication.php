<?php

namespace com\rd;

use NeoPHP\web\http\Session;
use NeoPHP\web\WebApplication as FrameworkWebApplication;

class WebApplication extends FrameworkWebApplication
{
    public function __construct()
    {
        parent::__construct();
        $this->setName ("Regalá Donando");
        $this->setRestfull (true);
    }
    
    public function getUrl($action = "", $params = array())
    {
        if (Session::getInstance()->isStarted() && isset(Session::getInstance()->sessionId))
        {
            $params = array_merge($params, [Session::getInstance()->getName()=>Session::getInstance()->getId()]);
        }
        return parent::getUrl($action, $params);
    }
}

?>