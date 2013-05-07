<?php
/**
 * Creates an iCalendar file.
 *
 * @package iCalendarFile
 * @since 1.0.0
 */

include( 'icalendar-file.php' );

// $event_id = @$_GET[ 'event_id' ];
$event_id = 1;
$event_name = 'Test Event';

$icalendar = new iCalendarFile( $event_id, $event_name );
$icalendar->set_event_description( 'This is the description for Test Event.' );
$icalendar->set_event_start( mktime( 8 ) );
$icalendar->set_event_end( mktime( 18 ) );
$icalendar->set_time_zone( 'America/Chicago' );

$venue = array(
	'venue_name' => 'Test Venue',
	'venue_address' => '2138 Wilson Rd.',
	'venue_address_two' => 'Apt. B9',
	'venue_city' => 'Knoxville',
	'venue_state' => 'TN',
	'venue_postal_code' => '37912'
);

$icalendar->set_venue( $venue );

$icalendar->create_ics_file();