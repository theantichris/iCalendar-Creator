<?php

namespace theantichris\iCalendarCreator;

class iCalendar
{
    private $eventName;
    private $eventDescription;
    private $organizerName;
    private $organizerEmail;
    private $timeZoneString;
    private $timeZoneObject;
    private $utcOffset;
    private $eventStart;
    private $eventEnd;
    private $eventLocation;

    function __construct($eventName)
    {
        $this->eventName = $eventName;
    }
}