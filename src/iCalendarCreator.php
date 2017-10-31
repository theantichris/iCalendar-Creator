<?php

namespace theantichris\iCalendarCreator;

/**
 * Class iCalendarCreator
 * @package theantichris\iCalendarCreator
 * @since 1.1.0
 */
class iCalendarCreator
{
    /**
     * Generates an ICS file.
     *
     * @since 1.0.0
     *
     * @param iCalendar $iCalendar
     */
    public static function createIcsFile(iCalendar $iCalendar)
    {
        /** @var string $fileName */
        $fileName = $iCalendar->getSlug() . '.ics';

        header("Content-Type: text/Calendar; charset=utf-8");
        header("Content-Disposition: inline; filename={$fileName}");

        echo "BEGIN:VCALENDAR\n";
        echo "VERSION:2.0\n";

        /** @var string $organizerName */
        $organizerName = $iCalendar->getOrganizerName();

        echo "PRODID:-//{$organizerName}//NONSGML {$iCalendar->getEventName()}//EN\n";
        echo "METHOD:REQUEST\n";
        echo "BEGIN:VEVENT\n";
        echo "UID:" . date('Ymd') . 'T' . date('His') . "-" . rand();

        if (!empty($organizerName)) {
            echo "-{$organizerName}\n";
        }

        echo "DTSTAMP:" . date('Ymd') . 'T' . date('His') . "\n";
        echo "ORGANIZER:CN={$organizerName}:MAILTO:{$iCalendar->getOrganizerEmail()}\n";
        echo "DTSTART:{$iCalendar->getEventStart()}\n";
        echo "DTEND:{$iCalendar->getEventEnd()}\n";
        echo "LOCATION:{$iCalendar->getEventLocation()}\n";
        echo "SUMMARY:{$iCalendar->getEventName()}\n";
        echo "DESCRIPTION: {$iCalendar->getEventDescription()}\n";
        echo "END:VEVENT\n";
        echo "END:VCALENDAR\n";
    }

    /**
     * Echoes the ICS file information.
     *
     * @since 1.0.0
     *
     * @param iCalendar $iCalendar
     */
    public static function viewIcsFile(iCalendar $iCalendar)
    {
        echo "BEGIN:VCALENDAR<br />";
        echo "VERSION:2.0<br />";

        /** @var string $organizerName */
        $organizerName = $iCalendar->getOrganizerName();

        echo "PRODID:-//{$organizerName}//NONSGML {$iCalendar->getEventName()}//EN<br />";
        echo "METHOD:REQUEST<br />";
        echo "BEGIN:VEVENT<br />";
        echo "UID:" . date('Ymd') . 'T' . date('His') . "-" . rand();

        if (!empty($organizerName)) {
            echo "-{$organizerName}";
        }

        echo "<br />";
        echo "DTSTAMP:" . date('Ymd') . 'T' . date('His') . "<br />";
        echo "ORGANIZER:CN={$organizerName}:MAILTO:{$iCalendar->getOrganizerEmail()}<br />";
        echo "DTSTART:{$iCalendar->getEventStart()}<br />";
        echo "DTEND:{$iCalendar->getEventEnd()}<br />";
        echo "LOCATION:{$iCalendar->getEventLocation()}<br />";
        echo "SUMMARY:{$iCalendar->getEventName()}<br />";
        echo "DESCRIPTION: {$iCalendar->getEventDescription()}<br />";
        echo "END:VEVENT<br />";
        echo "END:VCALENDAR<br />";
    }

	/**
	 * Create and return a string containing the ICS file
	 * To be used when you need the ICS file as an attachment to an email
	 *
	 * @since 1.1.0
	 *
	 * @param iCalendar $iCalendar
	 * @param string $uid optional uid for this event. This is needed if you want to send an update for the same event
	 *
	 * @return string
	 */
	public static function icsFileAsString(iCalendar $iCalendar, $uid='') {
		$organizerName = $iCalendar->getOrganizerName();

		$ics[0] = "BEGIN:VCALENDAR";
		$ics[1] = "VERSION:2.0";
		$ics[2] = "PRODID:-//{$organizerName}//NONSGML {$iCalendar->getEventName()}//EN";
		$ics[3] = "METHOD:REQUEST";
		$ics[4] = "BEGIN:VEVENT";
		
		if($uid === '') {
			$ics[5] = "UID:" . date('Ymd') . 'T' . date('His') . "-" . rand();
			if (!empty($organizerName)) {
				echo "-{$organizerName}";
			}
		} else {
			$ics[5] = $uid;
		}
		
		$ics[6] = "DTSTAMP:" . date('Ymd') . 'T' . date('His') . "";
		$ics[7] = "ORGANIZER:CN={$organizerName}:MAILTO:{$iCalendar->getOrganizerEmail()}";
		$ics[8] = "DTSTART:{$iCalendar->getEventStart()}";
		$ics[9] = "DTEND:{$iCalendar->getEventEnd()}";
		$ics[10] = "LOCATION:{$iCalendar->getEventLocation()}";
		$ics[11] = "SUMMARY:{$iCalendar->getEventName()}";
		$ics[12] = "DESCRIPTION: {$iCalendar->getEventDescription()}";
		$ics[13] = "END:VEVENT";
		$ics[14] = "END:VCALENDAR";
		
		return implode("\r\n", $ics);
	}

}
