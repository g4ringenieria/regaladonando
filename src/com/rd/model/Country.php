<?php

namespace com\rd\model;

use NeoPHP\mvc\Model;

/**
 * @Entity
 * @Table (name="country")
 */
class Country extends Model 
{   
    /**
     * @Id
     * @GeneratedValue
     * @Column (name="countryid", type="integer")
     */
    private $id;
    
    /**
     * @column (columnName="description")
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