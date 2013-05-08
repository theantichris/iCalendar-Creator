<?php
/**
 * Creates an iCalendar file.
 *
 * This page is the link the user will go to that get's the event data and creates the iCalendar file.
 *
 * @author Christopher Lamm chris@theantichris.com
 * @copyright 2013 Christopher Lamm
 * @license GNU General Public License, version 3
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link http://www.theantichris.com
 *
 * @version 1.0.0
 */

namespace iCalendarCreator;

require_once( 'icalendar-file.php' ); // Require the class file.

/* Setup data. */

// $event_id = @$_GET[ 'event_id' ];
$event_id = 1;

$event_name = 'Test Event';

$event_description = 'This is the description for Test Event.';

$organizer = 'Christopher Lamm';
$organizer_email = 'chris@theantichris.com';

$event_time_zone = 'America/Chicago';
date_default_timezone_set( $event_time_zone );

$event_start = mktime( 8, 0, 0 );
$event_end = mktime( 18, 0, 0 );

$venue = array(
	'venue_name' => 'Test Venue',
	'venue_address' => '2138 Wilson Rd.',
	'venue_address_two' => 'Apt. B9',
	'venue_city' => 'Knoxville',
	'venue_state' => 'TN',
	'venue_postal_code' => '37912'
);

/* Create iCalendar file. */

$icalendar = new iCalendarFile( $event_id, $event_name );

$icalendar->set_event_description( $event_description );
$icalendar->set_organizer( $organizer );
$icalendar->set_organizer_email( $organizer_email );
$icalendar->set_event_start( $event_start );
$icalendar->set_event_end( $event_end );
$icalendar->set_time_zone( $event_time_zone );

$icalendar->set_venue( $venue );

// $icalendar->create_ics_file(); // Creates the iCalendar file.

$icalendar->html_ics_file(); // Outputs the contents of the iCalendar file to HTML.