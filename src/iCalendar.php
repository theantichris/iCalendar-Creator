<?php

namespace theantichris\iCalendarCreator;

class iCalendar
{
    private $eventName;
    private $eventDescription;
    private $eventStart;
    private $eventEnd;
    private $eventLocation;
    private $organizerName;
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
}