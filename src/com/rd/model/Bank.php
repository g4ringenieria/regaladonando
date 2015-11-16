<?php

namespace com\rd\model;

use NeoPHP\mvc\Model;

/**
 * @Table (name="bank")
 */
class Bank extends Model 
{   
    /**
     * @Id
     * @GeneratedValue
     * @Column (name="bankid", type="integer")
     */
    private $id;
    
    /**
     *
     * @Column (type="string")
     */
    private $name;
    
    function __construct($id=null)
    {
        $this->id = $id;
    }

    public function getId() 
    {
        return $this->id;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }

    public function getName() 
    {
        return $this->name;
    }

    public function setName($name) 
    {
        $this->name = $name;
    }
}

?>