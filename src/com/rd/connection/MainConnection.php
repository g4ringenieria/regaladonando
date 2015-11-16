<?php

namespace com\rd\connection;

use NeoPHP\sql\PostgreSQLConnection;

class MainConnection extends PostgreSQLConnection
{
    public function getDatabaseName()
    {
        return "regaladonando";
    }

    public function getHost()
    {
        return "181.41.214.207";
    }
    
    public function getUsername ()
    {
        return "postgres";
    }
    
    public function getPassword ()
    {
        return "tuvieja.com";
    }
}

?>