<?php

namespace theantichris\iCalendarCreator;

class iCalendarFile
{
    /** @var null|string The name for the event. */
    public $eventName;
    /** @var string The iCalendar file name. */
    public $fileName;
    /** @var null|string The event eventDescription. */
    public $eventDescription;
    /** @var null|string The organizer of the event. */
    public $organizer;
    /** @var null|string The email of the event organizer. */
    public $organizerEmail;
    /** @var null|string The event's time zone. */
    public $timeZone;
    /** @var object Time zone object created from $this->timeZone. */
    public $timeZoneObject;
    /** @var integer Number of seconds between the event's time zone and UTC. */
    public $utcOffset;
    /** @var null|integer Event start time as an Epoch time stamp. */
    public $eventStart;
    /** @var null|integer Event end time as an Epoch time stamp. */
    public $eventEnd;
    /** @var array Venue information for the event. */
    public $eventLocation = array(
        'locationName',
        'locationAddress',
        'locationAddress2',
        'locationCity',
        'locationState',
        'locationPostalCode'
    );

    public function __construct($eventName = null)
    {
        if (empty($eventName)) {
            die();
        } else {
            $this->eventName = $eventName;
            $this->fileName  = strtolower(str_replace(array(' ', "'", '.'), array('_', '', ''), $this->eventName)) . '.ics';
        }
    }

    public function setEventDescription($eventDescription = null)
    {
        if (!empty($eventDescription)) {
            $this->eventDescription = $eventDescription;
        }
    }

    public function setOrganizer($organizer = null)
    {
        if (!empty($organizer)) {
            $this->organizer = $organizer;
        }
    }

    public function setOrganizerEmail($organizerEmail = null)
    {
        if (!empty($organizerEmail)) {
            $this->organizerEmail = $organizerEmail;
        }
    }

    public function setTimeZone($timeZone = null)
    {
        if (!empty($timeZone)) {
            $this->timeZone       = $timeZone;
            $this->timeZoneObject = new \DateTimeZone($timeZone);
            $this->utcOffset      = ($this->timeZoneObject->getOffset(new \DateTime())) * -1;
        }
    }

    public function setEventStart($eventStart = null)
    {
        if (!empty($eventStart)) {
            $this->eventStart = $eventStart;
        }
    }

    public function setEventEnd($eventEnd = null)
    {
        if (!empty($eventEnd)) {
            $this->eventEnd = $eventEnd;
        }
    }

    public function setEventLocation($eventLocation = null)
    {
        if ((!empty($eventLocation)) || !is_array($eventLocation)) {
            $this->eventLocation['locationName']       = $eventLocation['locationName'];
            $this->eventLocation['locationAddress']    = $eventLocation['locationAddress'];
            $this->eventLocation['locationAddress2']   = $eventLocation['locationAddress2'];
            $this->eventLocation['locationCity']       = $eventLocation['locationCity'];
            $this->eventLocation['locationState']      = $eventLocation['locationState'];
            $this->eventLocation['locationPostalCode'] = $eventLocation['locationPostalCode'];
        }
    }

    public function createIcsFile()
    {
        /** @var string $start Formatted start date and time. Converted to Zulu time. */
        $start = date('Ymd', $this->eventStart + $this->utcOffset) . 'T' . date('His', $this->eventStart + $this->utcOffset) . 'Z';
        /** @var string $end Formatted end date and time. Converted to Zulu time. */
        $end = date('Ymd', $this->eventEnd + $this->utcOffset) . 'T' . date('His', $this->eventEnd + $this->utcOffset) . 'Z';

        /** @var string $location Venue information combined into one string. */
        $location = $this->eventLocation['locationName'] . ', ' . $this->eventLocation['locationAddress'] . ', ';
        $location .= $this->eventLocation['locationAddress2'] . ', ' . $this->eventLocation['locationCity'] . ', ';
        $location .= $this->eventLocation['locationState'] . ' ' . $this->eventLocation['locationPostalCode'];

        header("Content-Type: text/Calendar; charset=utf-8");
        header("Content-Disposition: inline; filename={$this->fileName}");
        echo "BEGIN:VCALENDAR\n";
        echo "VERSION:2.0\n";
        echo "PRODID:-//{$this->organizer}//NONSGML {$this->eventName}//EN\n";
        echo "METHOD:REQUEST\n";
        echo "BEGIN:VEVENT\n";
        echo "UID:" . date('Ymd') . 'T' . date('His') . "-" . rand() . "-{$this->organizer}\n"; // Required by Outlook.
        echo "DTSTAMP:" . date('Ymd') . 'T' . date('His') . "\n";
        echo "ORGANIZER:CN={$this->organizer}:MAILTO:{$this->organizerEmail}\n";
        echo "DTSTART:{$start}\n";
        echo "DTEND:{$end}\n";
        echo "LOCATION:{$location}\n";
        echo "SUMMARY:{$this->eventName}\n";
        echo "DESCRIPTION: {$this->eventDescription}\n";
        echo "END:VEVENT\n";
        echo "END:VCALENDAR\n";
    }

    public function htmlIcsFile()
    {
        /** @var string $start Formatted start date and time. Converted to Zulu time. */
        $start = date('Ymd', $this->eventStart + $this->utcOffset) . 'T' . date('His', $this->eventStart + $this->utcOffset) . 'Z';
        /** @var string $end Formatted end date and time. Converted to Zulu time. */
        $end = date('Ymd', $this->eventEnd + $this->utcOffset) . 'T' . date('His', $this->eventEnd + $this->utcOffset) . 'Z';

        /** @var string $location Venue information combined into one string. */
        $location = $this->eventLocation['locationName'] . ', ' . $this->eventLocation['locationAddress'] . ', ';
        $location .= $this->eventLocation['locationAddress2'] . ', ' . $this->eventLocation['locationCity'] . ', ';
        $location .= $this->eventLocation['locationState'] . ' ' . $this->eventLocation['locationPostalCode'];

        echo "BEGIN:VCALENDAR<br />";
        echo "VERSION:2.0<br />";
        echo "PRODID:-//{$this->organizer}//NONSGML {$this->eventName}//EN<br />";
        echo "METHOD:REQUEST<br />";
        echo "BEGIN:VEVENT<br />";
        echo "UID:" . date('Ymd') . 'T' . date('His') . "-" . rand() . "-{$this->organizer}<br />"; // Required by Outlook.
        echo "DTSTAMP:" . date('Ymd') . 'T' . date('His') . "<br />";
        echo "ORGANIZER:CN={$this->organizer}:MAILTO:{$this->organizerEmail}<br />";
        echo "DTSTART:{$start}<br />";
        echo "DTEND:{$end}<br />";
        echo "LOCATION:{$location}<br />";
        echo "SUMMARY:{$this->eventName}<br />";
        echo "DESCRIPTION: {$this->eventDescription}<br />";
        echo "END:VEVENT<br />";
        echo "END:VCALENDAR<br />";
    }
}