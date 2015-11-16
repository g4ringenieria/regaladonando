<?php

namespace com\rd\model;

use NeoPHP\mvc\Model;

/**
 * @Table (name="bankaccounttype")
 */
class BankAccountType extends Model 
{   
    /**
     * @Id
     * @GeneratedValue
     * @Column (name="bankaccounttypeid", type="integer")
     */
    private $id;
    
    /**
     *
     * @Column (type="string")
     */
    private $description;
    
    public function __construct($id=null)
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

    public function getDescription() 
    {
        return $this->description;
    }

    public function setDescription($description) 
    {
        $this->description = $description;
    }
}

?>