<?php
/**
 * Class for creating an iCalendar file.
 *
 * @author    Christopher Lamm chris@theantichris.com
 * @copyright 2013 Christopher Lamm
 * @license   GNU General Public License, version 3
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      http://www.theantichris.com
 */

namespace iCalendarCreator;

/**
 * Class for creating an iCalendar file.
 *
 * Accepts data and uses that to create an iCalendar (.ics) file.
 *
 * @author  Christopher Lamm chris@theantichris.com
 * @license GNU General Public License, version 3
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @version 2.0.0
 */
class iCalendarFile {
	/** @var null|string The name for the event. */
	public $event_name;
	/** @var string The iCalendar file name. */
	public $file_name;
	/** @var  null|string The event description. */
	public $event_description;
	/** @var  null|string The organizer of the event. */
	public $organizer;
	/** @var  null|string The email of the event organizer. */
	public $organizer_email;
	/** @var  null|string The event's time zone. */
	public $time_zone;
	/** @var  object Time zone object created from $this->time_zone. */
	public $time_zone_object;
	/** @var  integer Number of seconds between the event's time zone and UTC. */
	public $utc_offset;
	/** @var  null|integer Event start time as an Epoch time stamp. */
	public $event_start;
	/** @var  null|integer Event end time as an Epoch time stamp. */
	public $event_end;
	/** @var array Venue information for the event. */
	public $venue = array(
		'venue_name',
		'venue_address',
		'venue_address_two',
		'venue_city',
		'venue_state',
		'venue_postal_code'
	);

	/**
	 * Object constructor.
	 *
	 * If the event name isn't empty and the event ID exists and is an integer a new object will be created.
	 *
	 * @since 1.0.0
	 *
	 * @param string $event_name Name of the event.
	 */
	public function __construct( $event_name = null ) {
		if ( empty( $event_name ) ) {
			die();
		} else {
			$this->event_name = $event_name;
			$this->file_name  = strtolower( str_replace( array( ' ', "'", '.' ), array( '_', '', '' ), $event_name ) ) . '.ics';
		}
	}

	/**
	 * Checks for, validates, and assigns the event description.
	 *
	 * @since 1.0.0
	 *
	 * @param null|string $event_description Description of the event.
	 *
	 * @return void
	 */
	public function set_event_description( $event_description = null ) {
		if ( !empty( $event_description ) ) {
			$this->event_description = $event_description;
		}
	}

	/**
	 * Checks for, validates, and assigns the event organizer.
	 *
	 * @since 1.0.0
	 *
	 * @param null|string $organizer Organizer of the event.
	 *
	 * @return void
	 */
	public function set_organizer( $organizer = null ) {
		if ( !empty( $organizer ) ) {
			$this->organizer = $organizer;
		}
	}

	/**
	 * Checks for, validates, and assigns the event organizer's email.
	 *
	 * @since 1.0.0
	 *
	 * @param null|string $organizer_email Organizer's email.
	 *
	 * @return void
	 */
	public function set_organizer_email( $organizer_email = null ) {
		if ( !empty( $organizer_email ) ) {
			$this->organizer_email = $organizer_email;
		}
	}

	/**
	 * Checks for, validates, and assigns the time zone.
	 *
	 * @since 1.0.0
	 *
	 * @param null|string $time_zone
	 *
	 * @return void
	 */
	public function set_time_zone( $time_zone = null ) {
		if ( !empty( $time_zone ) ) {
			$this->time_zone        = $time_zone;
			$this->time_zone_object = new DateTimeZone( $time_zone );
			$this->utc_offset       = ( $this->time_zone_object->getOffset( new DateTime() ) ) * -1;
		}
	}

	/**
	 * Checks for, validates, and assigns the event start time.
	 *
	 * @since 1.0.0
	 *
	 * @param null|integer $event_start
	 *
	 * @return void
	 */
	public function set_event_start( $event_start = null ) {
		if ( !empty( $event_start ) ) {
			$this->event_start = $event_start;
		}
	}

	/**
	 * Checks for, validates, and assigns the event end time.
	 *
	 * @since 1.0.0
	 *
	 * @param null|integer $event_end
	 *
	 * @return void
	 */
	public function set_event_end( $event_end = null ) {
		if ( !empty( $event_end ) ) {
			$this->event_end = $event_end;
		}
	}

	/**
	 * Checks for, validates, and assigns the venue.
	 *
	 * @since 1.0.0
	 *
	 * @param null|array $venue
	 *
	 * @return void
	 */
	public function set_venue( $venue = null ) {
		if ( ( !empty( $venue ) ) || !is_array( $venue ) ) {
			$this->venue[ 'venue_name' ]        = $venue[ 'venue_name' ];
			$this->venue[ 'venue_address' ]     = $venue[ 'venue_address' ];
			$this->venue[ 'venue_address_two' ] = $venue[ 'venue_address_two' ];
			$this->venue[ 'venue_city' ]        = $venue[ 'venue_city' ];
			$this->venue[ 'venue_state' ]       = $venue[ 'venue_state' ];
			$this->venue[ 'venue_postal_code' ] = $venue[ 'venue_postal_code' ];
		}
	}

	/**
	 * Creates the iCalendar file.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function create_ics_file() {
		/** @var string $start Formatted start date and time. Converted to Zulu time. */
		$start = date( 'Ymd', $this->event_start + $this->utc_offset ) . 'T' . date( 'His', $this->event_start + $this->utc_offset ) . 'Z';
		/** @var string $end Formatted end date and time. Converted to Zulu time. */
		$end = date( 'Ymd', $this->event_end + $this->utc_offset ) . 'T' . date( 'His', $this->event_end + $this->utc_offset ) . 'Z';

		/** @var string $location Venue information combined into one string. */
		$location = $this->venue[ 'venue_name' ] . ', ' . $this->venue[ 'venue_address' ] . ', ';
		$location .= $this->venue[ 'venue_address_two' ] . ', ' . $this->venue[ 'venue_city' ] . ', ';
		$location .= $this->venue[ 'venue_state' ] . ' ' . $this->venue[ 'venue_postal_code' ];

		header( "Content-Type: text/Calendar; charset=utf-8" );
		header( "Content-Disposition: inline; filename={$this->file_name}" );
		echo "BEGIN:VCALENDAR\n";
		echo "VERSION:2.0\n";
		echo "PRODID:-//{$this->organizer}//NONSGML {$this->event_name}//EN\n";
		echo "METHOD:REQUEST\n";
		echo "BEGIN:VEVENT\n";
		echo "UID:" . date( 'Ymd' ) . 'T' . date( 'His' ) . "-" . rand() . "-{$this->organizer}\n"; // Required by Outlook.
		echo "DTSTAMP:" . date( 'Ymd' ) . 'T' . date( 'His' ) . "\n";
		echo "ORGANIZER:CN={$this->organizer}:MAILTO:{$this->organizer_email}\n";
		echo "DTSTART:{$start}\n";
		echo "DTEND:{$end}\n";
		echo "LOCATION:{$location}\n";
		echo "SUMMARY:{$this->event_name}\n";
		echo "DESCRIPTION: {$this->event_description}\n";
		echo "END:VEVENT\n";
		echo "END:VCALENDAR\n";
	}

	/**
	 * Outputs what would be the iCalendar file as HTML.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function html_ics_file() {
		/** @var string $start Formatted start date and time. Converted to Zulu time. */
		$start = date( 'Ymd', $this->event_start + $this->utc_offset ) . 'T' . date( 'His', $this->event_start + $this->utc_offset ) . 'Z';
		/** @var string $end Formatted end date and time. Converted to Zulu time. */
		$end = date( 'Ymd', $this->event_end + $this->utc_offset ) . 'T' . date( 'His', $this->event_end + $this->utc_offset ) . 'Z';

		/** @var string $location Venue information combined into one string. */
		$location = $this->venue[ 'venue_name' ] . ', ' . $this->venue[ 'venue_address' ] . ', ';
		$location .= $this->venue[ 'venue_address_two' ] . ', ' . $this->venue[ 'venue_city' ] . ', ';
		$location .= $this->venue[ 'venue_state' ] . ' ' . $this->venue[ 'venue_postal_code' ];

		echo "BEGIN:VCALENDAR<br />";
		echo "VERSION:2.0<br />";
		echo "PRODID:-//{$this->organizer}//NONSGML {$this->event_name}//EN<br />";
		echo "METHOD:REQUEST<br />";
		echo "BEGIN:VEVENT<br />";
		echo "UID:" . date( 'Ymd' ) . 'T' . date( 'His' ) . "-" . rand() . "-{$this->organizer}<br />"; // Required by Outlook.
		echo "DTSTAMP:" . date( 'Ymd' ) . 'T' . date( 'His' ) . "<br />";
		echo "ORGANIZER:CN={$this->organizer}:MAILTO:{$this->organizer_email}<br />";
		echo "DTSTART:{$start}<br />";
		echo "DTEND:{$end}<br />";
		echo "LOCATION:{$location}<br />";
		echo "SUMMARY:{$this->event_name}<br />";
		echo "DESCRIPTION: {$this->event_description}<br />";
		echo "END:VEVENT<br />";
		echo "END:VCALENDAR<br />";
	}

}