<?php
/**
 * Creates an iCalendar file.
 *
 * @package iCalendarFile
 * @since 1.0.0
 */

// Require the class file.
require_once( 'icalendar-file.php' );

/*
 * Setup data.
 */

// $event_id = @$_GET[ 'event_id' ];
$event_id = 1;

$event_name = 'Test Event';

$event_description = 'This is the description for Test Event.';

$event_time_zone = 'America/Chicago';
date_default_timezone_set( $event_time_zone );

$event_start = time();
$event_end = time();

$venue = array(
	'venue_name' => 'Test Venue',
	'venue_address' => '2138 Wilson Rd.',
	'venue_address_two' => 'Apt. B9',
	'venue_city' => 'Knoxville',
	'venue_state' => 'TN',
	'venue_postal_code' => '37912'
);

/*
 * Create iCalendar file.
 */

$icalendar = new iCalendarFile( $event_id, $event_name );
$icalendar->set_event_description( $event_description );
$icalendar->set_event_start( $event_start );
$icalendar->set_event_end( $event_end );
$icalendar->set_time_zone( $event_time_zone );

$icalendar->set_venue( $venue );

// $icalendar->create_ics_file();

$icalendar->html_ics_file();