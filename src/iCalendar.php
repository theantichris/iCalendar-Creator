<?php

namespace theantichris\iCalendarCreator;

/**
 * Class iCalendar
 * @package theantichris\iCalendarCreator
 * @since 1.0.0
 */
class iCalendar
{
    /** @var string */
    private $eventName;
    /** @var string */
    private $eventDescription;
    /** @var \DateTime|null */
    private $eventStart;
    /** @var \DateTime|null */
    private $eventEnd;
    /** @var null|Location */
    private $eventLocation;
    /** @var string */
    private $organizerName;
    /** @var string */
    private $organizerEmail;

    /**
     * @since 1.0.0
     *
     * @param string $eventName
     * @param string $eventDescription
     * @param \DateTime|null $eventStart
     * @param \DateTime|null $eventEnd
     * @param Location|null $eventLocation
     * @param string $organizerName
     * @param string $organizerEmail
     */
    function __construct($eventName, $eventDescription = '', \DateTime $eventStart = null, \DateTime $eventEnd = null, Location $eventLocation = null, $organizerName = '', $organizerEmail = '')
    {
        $this->eventName        = $eventName;
        $this->eventDescription = $eventDescription;
        $this->eventStart       = $eventStart;
        $this->eventEnd         = $eventEnd;
        $this->eventLocation    = $eventLocation;
        $this->organizerName    = $organizerName;
        $this->organizerEmail   = $organizerEmail;
    }

    /**
     * @since 1.0.0
     *
     * @return string
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * @since 1.0.0
     *
     * @return string
     */
    public function getSlug()
    {
        return strtolower(str_replace(array(' ', "'", '.'), array('_', '', ''), $this->eventName));
    }

    /**
     * @since 1.0.0
     *
     * @return string
     */
    public function getEventDescription()
    {
        return $this->eventDescription;
    }

    /**
     * @since 1.0.0
     *
     * @return \DateTime|null
     */
    public function getEventStart()
    {
        return $this->eventStart;
    }

    /**
     * @since 1.0.0
     *
     * @return \DateTime|null
     */
    public function getEventEnd()
    {
        return $this->eventEnd;
    }

    /**
     * @since 1.0.0
     *
     * @return null|Location
     */
    public function getEventLocation()
    {
        return $this->eventLocation;
    }

    /**
     * @since 1.0.0
     *
     * @return string
     */
    public function getOrganizerName()
    {
        return $this->organizerName;
    }

    /**
     * @since 1.0.0
     *
     * @return string
     */
    public function getOrganizerEmail()
    {
        return $this->organizerEmail;
    }
}