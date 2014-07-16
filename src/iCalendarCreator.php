<?php

namespace theantichris\iCalendarCreator;

/**
 * Class iCalendarCreator
 * @package theantichris\iCalendarCreator
 * @since 1.0.0
 */
class iCalendarCreator
{
    public static function createIcsFile(iCalendar $iCalendar)
    {
        header("Content-Type: text/Calendar; charset=utf-8");
        header("Content-Disposition: inline; filename={$iCalendar->getSlug()}");

        echo "BEGIN:VCALENDAR\n";
        echo "VERSION:2.0\n";
        echo "PRODID:-//{$iCalendar->getOrganizerName()}//NONSGML {$iCalendar->getEventName()}//EN\n";
        echo "METHOD:REQUEST\n";
        echo "BEGIN:VEVENT\n";
        echo "UID:" . date('Ymd') . 'T' . date('His') . "-" . rand() . "-{$iCalendar->getOrganizerName()}\n";
        echo "DTSTAMP:" . date('Ymd') . 'T' . date('His') . "\n";
        echo "ORGANIZER:CN={$iCalendar->getOrganizerName()}:MAILTO:{$iCalendar->getOrganizerEmail()}\n";
        echo "DTSTART:{$iCalendar->getEventStart()}\n";
        echo "DTEND:{$iCalendar->getEventEnd()}\n";
        echo "LOCATION:{$iCalendar->getEventLocation()}\n";
        echo "SUMMARY:{$iCalendar->getEventName()}\n";
        echo "DESCRIPTION: {$iCalendar->getEventDescription()}\n";
        echo "END:VEVENT\n";
        echo "END:VCALENDAR\n";
    }
}