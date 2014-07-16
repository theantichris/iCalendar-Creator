<?php

namespace theantichris\iCalendarCreator;

/**
 * Class Location
 * Holds location information to use in the ICS file.
 * @package theantichris\iCalendarCreator
 * @since 1.0.0
 */
class Location
{
    /** @var string Name */
    private $name;
    /** @var string Address line 1. */
    private $address1;
    /** @var string Address line 2 */
    private $address2;
    /** @var string City */
    private $city;
    /** @var string State */
    private $state;
    /** @var string Postal code */
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
        $this->name       = $name;
        $this->address1   = $address1;
        $this->address2   = $address2;
        $this->city       = $city;
        $this->state      = $state;
        $this->postalCode = $postalCode;
    }
} 