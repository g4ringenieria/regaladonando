<?php

namespace com\rd\model;

use NeoPHP\mvc\Model;

/**
 * @table (tableName="timezone")
 */
class TimeZone extends Model 
{   
    /**
     * @column (columnName="timezoneid", id=true)
     */
    private $id;
    
    /**
     * @column (columnName="description")
     */
    private $description;
    
    /**
     * @column (columnName="value")
     */
    private $value;
    
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
    
    public function getValue ()
    {
        return $this->value;
    }

    public function setValue($value) 
    {
        $this->value = $value;
    }
}

?>