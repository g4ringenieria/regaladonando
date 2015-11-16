<?php

namespace com\rd\controller;

use com\rd\connection\MainConnection;
use com\rd\model\User;
use NeoPHP\web\http\Response;
use NeoPHP\web\WebRestController;

class SessionController extends WebRestController
{   
    public function updateResource ($username, $password)
    {
        $conn = MainConnection::getInstance();
        $userTable = $conn->getTable("\"user\"");
        $userTable->addWhere("username", "=", $username);
        $userTable->addWhere("password", "=", base64_encode(hash("md5",$password,true)));
        $userTable->addWhere("active", "=", "true");
        $user = $userTable->getFirst(User::getClass());
        
        $response = new Response();
        if ($user != null)
        {
            $this->getSession()->start();
            $this->getSession()->sessionId = session_id();
            $this->getSession()->sessionName = session_name();
            $this->getSession()->userId = $user->getId();
            $this->getSession()->firstName = $user->getFirstname();
            $this->getSession()->lastName = $user->getLastname();
            $response->setContent($this->getSession()->sessionId);
        }
        else
        {
            $response->setStatusCode(401);
            $response->setContent("Nombre de usuario o contraseña incorrecta");
        }
        return $response;
    }
}