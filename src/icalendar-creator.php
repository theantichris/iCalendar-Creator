<?php

namespace theantichris\iCalendarCreator;

$eventName = 'Test Event';

$eventDescription = 'This is the eventDescription for Test Event.';

$organizer      = 'Christopher Lamm';
$organizerEmail = 'chris@theantichris.com';

$eventTimeZone = 'America/Chicago';
date_default_timezone_set($eventTimeZone);

$eventStart = mktime(8, 0, 0);
$eventEnd   = mktime(18, 0, 0);

$location = array(
    'locationName'       => 'Test Venue',
    'locationAddress'    => '2138 Wilson Rd.',
    'locationAddressTwo' => 'Apt. B9',
    'locationCity'       => 'Knoxville',
    'locationState'      => 'TN',
    'locationPostalCode' => '37912'
);

$icalendar = new iCalendarFile($eventName);

$icalendar->setEventDescription($eventDescription);
$icalendar->setOrganizer($organizer);
$icalendar->setOrganizerEmail($organizerEmail);
$icalendar->setEventStart($eventStart);
$icalendar->setEventEnd($eventEnd);
$icalendar->setTimeZone($eventTimeZone);

$icalendar->setEventLocation($location);

// $icalendar->createIcsFile(); // Creates the iCalendar file.

$icalendar->htmlIcsFile(); // Outputs the contents of the iCalendar file to HTML.