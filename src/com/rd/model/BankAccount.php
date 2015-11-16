<?php

namespace com\rd\model;

use NeoPHP\mvc\Model;

/**
 * @Entity
 * @Table (name="bankaccount")
 */
class BankAccount extends Model 
{   
    /**
     * @Id
     * @GeneratedValue
     * @Column (name="bankaccountid", type="integer")
     */
    private $id;
    
    /**
     * @ManyToOne (targetEntity="User")
     * @JoinColumn (name="userid", referencedColumnName="userid")
     */
    private $user;
    
    /**
     * @ManyToOne (targetEntity="Bank")
     * @JoinColumn (name="bankid", referencedColumnName="bankid")
     */
    private $bank;
    
    /**
     * @ManyToOne (targetEntity="BankAccountType")
     * @JoinColumn (name="bankaccounttypeid", referencedColumnName="bankaccounttypeid")
     */
    private $type;
    
    /**
     * @Column (type="integer")
     */
    private $number;
    
    /**
     * @Column (type="integer")
     */
    private $cbu;
    
    /**
     * @Column (type="string")
     */
    private $owner;
    
    /**
     * @Column (type="string")
     */
    private $cuil;
    
    function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getBank()
    {
        return $this->bank;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getCbu()
    {
        return $this->cbu;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function setBank(Bank $bank)
    {
        $this->bank = $bank;
    }

    public function setType(BankAccountType $type)
    {
        $this->type = $type;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function setCbu($cbu)
    {
        $this->cbu = $cbu;
    }

    public function setOwner($owner)
    {
        $this->owner = $owner;
    }
    
    public function getCuil()
    {
        return $this->cuil;
    }

    public function setCuil($cuil)
    {
        $this->cuil = $cuil;
    }
}

?>