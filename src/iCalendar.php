<?php

namespace theantichris\iCalendarCreator;

class iCalendar
{
    private $eventName;
    private $eventDescription;
    private $organizerName;
    private $organizerEmail;
    private $utcOffset;
    private $eventStart;
    private $eventEnd;
    private $eventLocation;

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
     * @param string $timeZoneString
     */
    function __construct($eventName, $eventDescription = '', \DateTime $eventStart = null, \DateTime $eventEnd = null, Location $eventLocation = null, $organizerName = '', $organizerEmail = '', $timeZoneString = '')
    {
        $this->eventName        = $eventName;
        $this->eventDescription = $eventDescription;
        $this->eventStart       = $eventStart;
        $this->eventEnd         = $eventEnd;
        $this->eventLocation    = $eventLocation;
        $this->organizerName    = $organizerName;
        $this->organizerEmail   = $organizerEmail;
        $this->utcOffset        = $this->setUtcOffset($timeZoneString);
    }

    /**
     * @since 1.0.0
     *
     * @param string $timeZoneString
     * @return int
     */
    private function setUtcOffset($timeZoneString)
    {
        $timeZoneObject = new \DateTimeZone($timeZoneString);
        return ($timeZoneObject->getOffset(new \DateTime())) * -1;
    }
}