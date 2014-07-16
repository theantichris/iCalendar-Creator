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

    function __construct($eventName, $eventDescription = '', $eventStart = '', $eventEnd = '', $eventLocation = '', $organizerName = '', $organizerEmail = '', $timeZoneString = '')
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

    private function setUtcOffset($timeZoneString)
    {
        $timeZoneObject = new \DateTimeZone($timeZoneString);
        return ($timeZoneObject->getOffset(new \DateTime())) * -1;
    }
}