<?php

namespace com\rd\model;

use NeoPHP\mvc\Model;

/**
 * @Entity
 * @Table (name="foundation")
 */
class Foundation extends Model 
{
    /**
     * @Id
     * @GeneratedValue
     * @Column (name="foundationid", type="integer")
     */
    private $id;
    
    /**
     * @Column (name="businessname", type="string")
     */
    private $name;
    
    /**
     * @Column (type="string")
     */
    private $cuit;
    
    /**
     * @Column (type="string")
     */
    private $address;
    
    /**
     * @OneToOne (targetEntity="Country")
     * @JoinColumn (name="countryid", referencedColumnName="countryid")
     */
    private $country;
    
    /**
     * @Column (type="string")
     */
    private $phones;
    
    /**
     * @Column (type="string")
     */
    private $emails;
    
    /**
     * @Column (type="string")
     */
    private $url;
    
    /**
     * @Column (type="string")
     */
    private $logoUrl;
    
    /**
     * @Column (type="string")
     */
    private $images;
    
    public function __construct($id=null)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCuit()
    {
        return $this->cuit;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getPhones()
    {
        return $this->phones;
    }

    public function getEmails()
    {
        return $this->emails;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getLogoUrl()
    {
        return $this->logoUrl;
    }

    public function getImages()
    {
        return $this->images;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setCuit($cuit)
    {
        $this->cuit = $cuit;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function setPhones($phones)
    {
        $this->phones = $phones;
    }

    public function setEmails($emails)
    {
        $this->emails = $emails;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setLogoUrl($logoUrl)
    {
        $this->logoUrl = $logoUrl;
    }

    public function setImages($images)
    {
        $this->images = $images;
    }


}