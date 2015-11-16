<?php

namespace com\rd\model;

use NeoPHP\mvc\Model;

/**
 * @Entity
 * @Table (name='\"user\"')
 */
class User extends Model
{
    const DEFAULT_HASH_KEY = "regaladonando";
    
    /**
     * @Id
     * @GeneratedValue
     * @Column (name="userid", type="integer")
     */
    private $id;
    
    /**
     * @Column (type="boolean")
     */
    private $active;
    
    /**
     * @Column (type="string")
     */
    private $username;
    
    /**
     * @Column (type="string")
     */
    private $password;
    
    /**
     * @OneToOne (targetEntity="UserType")
     * @JoinColumn (name="usertypeid", referencedColumnName="usertypeid")
     */
    private $type;
    
    /**
     * @Column (type="string")
     */
    private $firstname;
    
    /**
     * @Column (type="string")
     */
    private $lastname;
    
    /**
     * @Column (type="string")
     */
    private $language;
    
    /**
     * @Column (name="timezoneid", type="string")
     */
    private $timezone;
    
    /**
     * @Column (name="birthdate", type="date")
     */
    private $birthDate;
    
    /**
     * @Column (type="string")
     */
    private $address;
    
    /**
     * @Column (name="countryid", type="string")
     */
    private $country;
    
    /**
     * @Column (type="string")
     */
    private $phone;
    
    /**
     * @Column (type="string")
     */
    private $email;
    
    /**
     * @Column (name="documenttypeid", type="string")
     */
    private $documentType;
    
    /**
     * @Column (name="documentnumber", type="string")
     */
    private $documentNumber;
    
    /**
     * @Column (type="string")
     */
    private $avatar;
    
    /**
     * @Column (type="string")
     */
    private $hash;
    
    /**
     * @Column (type="string")
     */
    private $lastreset;
      
    /**
     * @OneToMany (targetClass="BankAccount")
     */
    private $bankAccounts = [];
    
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
    
    public function getActive ()
    {
        return $this->active;
    }

    public function setActive ( $active )
    {
        $this->active = $active;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType(UserType $type)
    {
        $this->type = $type;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }
    
    public function getLanguage ()
    {
        return $this->language;
    }
    
    public function setLanguage ( $language )
    {
        $this->language = $language;
    }

    public function getTimezone ()
    {
        return $this->timezone;
    }

    public function setTimezone ( $timezone )
    {
        $this->timezone = $timezone;
    }
    
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }
    
    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    function getDocumentType ()
    {
        return $this->documentType;
    }

    function setDocumentType ( $documentType )
    {
        $this->documentType = $documentType;
    }

    public function getDocumentNumber()
    {
        return $this->documentNumber;
    }

    public function setDocumentNumber($documentNumber)
    {
        $this->documentNumber = $documentNumber;
    }
    
    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }
    
    public function getHash ()
    {
        return $this->hash;
    }

    public function setHash ( $hash )
    {
        $this->hash = $hash;
    }
    
    public function getLastreset ()
    {
        return $this->lastreset;
    }

    public function setLastreset ( $lastreset )
    {
        $this->lastreset = $lastreset;
    }
    
    public function getBankAccounts()
    {
        return $this->bankAccounts;
    }

    public function setBankAccounts(array $bankAccounts)
    {
        $this->bankAccounts = $bankAccounts;
    }

    public function addBankAccount($bankAccount)
    {
        $this->bankAccounts[] = $bankAccount;
    }
}

?>
