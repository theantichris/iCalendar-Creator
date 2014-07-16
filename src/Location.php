<?php

namespace theantichris\iCalendarCreator;

class Location
{
    private $name;
    private $address1;
    private $address2;
    private $city;
    private $state;
    private $postalCode;

    /**
     * @since 1.0.0
     *
     * @param string $name
     * @param string $address1
     * @param string $address2
     * @param string $city
     * @param string $state
     * @param string $postalCode
     */
    public function __construct($name, $address1 = '', $address2 = '', $city = '', $state = '', $postalCode = '')
    {
        $this->setName($name);
        $this->setAddress1($address1);
        $this->setAddress2($address2);
        $this->setCity($city);
        $this->setState($state);
        $this->setPostalCode($postalCode);
    }

    /**
     * @since 1.0.0
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @since 1.0.0
     *
     * @param string $name
     * @return Location
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @since 1.0.0
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @since 1.0.0
     *
     * @param string $address1
     * @return Location
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
        return $this;
    }

    /**
     * @since 1.0.0
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @since 1.0.0
     *
     * @param string $address2
     * @return Location
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
        return $this;
    }

    /**
     * @since 1.0.0
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @since 1.0.0
     *
     * @param string $city
     * @return Location
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @since 1.0.0
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @since 1.0.0
     *
     * @param string $state
     * @return Location
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @since 1.0.0
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @since 1.0.0
     *
     * @param string $postalCode
     * @return Location
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }
} 