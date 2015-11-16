<?php

namespace com\rd\model;

use NeoPHP\mvc\Model;

/**
 * @Entity
 * @Table (name="event")
 */
class Event extends Model
{
    /**
     * @Id
     * @GeneratedValue
     * @Column (name="eventid", type="integer")
     */
   private $id;
    
    /**
     * @Column (type="string")
     */
    private $name;
    
    /**
     * @Column (type="string")
     */
    private $description;
    
    /**
     * @OneToOne (targetEntity="User")
     * @JoinColumn (name="userid", referencedColumnName="userid")
     */
    private $user;
    
    /**
     * @OneToOne (targetEntity="Foundation")
     * @JoinColumn (name="foundationid", referencedColumnName="foundationid")
     */
    private $foundation;
    
    /**
     * @Column (name="expectedenddate", type="datetime")
     */
    private $date;
    
    /**
     * @Column (name="creationdate", type="datetime")
     */
    private $creationDate;
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getFoundation()
    {
        return $this->foundation;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function setFoundation($foundation)
    {
        $this->foundation = $foundation;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }
}