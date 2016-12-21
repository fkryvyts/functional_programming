<?php
/**
 * Created by PhpStorm.
 * Author: garcher
 * Date: 12.12.16
 * Time: 03:16
 */

namespace Unity\FunctionalDemo\Helper;

class ContactInformation
{
    /** @var string */
    private $street;

    /** @var string */
    private $city;

    /** @var string */
    private $country;

    /** @var string */
    private $zipCode;

    /**
     * ContactInformation constructor.
     * @param string $street
     * @param string $city
     * @param string $country
     * @param string $zipCode
     */
    public function __construct($street, $city, $country, $zipCode)
    {
        $this->street = $street;
        $this->city = $city;
        $this->country = $country;
        $this->zipCode = $zipCode;
    }

    /**
     * @return string
     */
    public function getStreet() : string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getCity() : string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getCountry() : string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getZipCode() : string
    {
        return $this->zipCode;
    }

}