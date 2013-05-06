<?php
/**
 * iCalendarFile class file.
 *
 * @package iCalendarFile
 * @version 1.0.0
 */

/**
 * Class iCalendarFile
 *
 * @since 1.0.0
 */
class iCalendarFile {
	public $event_id;
	public $file_name;
	public $event_name;
	public $event_description;
	public $time_zone;
	public $event_start;
	public $event_end;
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
	 * @param integer $event_id Unique ID for the event.
	 * @param string $event_name Name of the event.
	 * return void
	 */
	public function __construct( $event_id = null, $event_name = null ) {
		if ( ( empty( $event_id ) ) || ( !is_numeric( $event_id ) ) || ( empty( $event_name ) ) ) {
			die();
		} else {
			$this->event_id = $event_id;
			$this->event_name = $event_name;
			$this->file_name = strtolower( str_replace( array( ' ', "'", '.' ), array( '_', '', '' ), $event_name ) ) . '.ics';
		}
	}

	/**
	 * Checks for, validates, and assigns the event description.
	 *
	 * @since 1.0.0
	 *
	 * @param null|string $event_description Description of the event.
	 * return void
	 */
	public function set_event_description( $event_description = null ) {
		if ( !empty( $event_description ) ) {
			$this->event_description = $event_description;
		}
	}

	/**
	 * Checks for, validates, and assigns the time zone.
	 *
	 * @since 1.0.0
	 *
	 * @param null $time_zone
	 * return void
	 */
	public function set_time_zone( $time_zone = null ) {
		if ( !empty( $time_zone ) ) {
			$this->time_zone = $time_zone;
		}
	}

	/**
	 * Checks for, validates, and assigns the event start time.
	 *
	 * @since 1.0.0
	 *
	 * @param null $event_start
	 * return void
	 */
	public function set_event_start( $event_start = null ) {
		if ( empty( $event_start ) ) {
			$this->event_start = $event_start;
		}
	}

	/**
	 * Checks for, validates, and assigns the event end time.
	 *
	 * @since 1.0.0
	 *
	 * @param null $event_end
	 * return void
	 */
	public function set_event_end( $event_end = null ) {
		if ( empty( $event_end ) ) {
			$this->event_end = $event_end;
		}
	}

	/**
	 * Checks for, validates, and assigns the venue.
	 *
	 * @since 1.0.0
	 *
	 * @param null $venue
	 * return void
	 */
	public function set_venue( $venue = null ) {
		if ( ( !empty( $venue ) ) || !is_array( $venue ) ) {
			$this->venue[ 'venue_name' ] = $venue[ 'venue_name' ];
			$this->venue[ 'venue_address' ] = $venue[ 'venue_address' ];
			$this->venue[ 'venue_address_two' ] = $venue[ 'venue_address_two' ];
			$this->venue[ 'venue_city' ] = $venue[ 'venue_city' ];
			$this->venue[ 'venue_state' ] = $venue[ 'venue_state' ];
			$this->venue[ 'venue_postal_code' ] = $venue[ 'venue_postal_code' ];
		}
	}

	public function create_ics_file() {
		/** @var string $start Formatted start date and time. */
		$start = date( 'Ymd', $this->event_start + 21000 ) . 'T' . date( 'His', $this->event_start + 21000 ) . 'Z';
		/** @var string $end Formatted end date and time. */
		$end = date( 'Ymd', $this->event_end + 21000 ) . 'T' . date( 'His', $this->event_end + 21000 ) . 'Z';

		/** @var string $location Venue information combined into one string. */
		$location = $this->venue[ 'venue_name' ] . ', ' . $this->venue[ 'venue_address' ] . ', ';
		$location .= $this->venue[ 'venue_address_two' ] . ', ' . $this->venue[ 'venue_city' ] . ', ';
		$location .= $this->venue[ 'venue_state' ] . ' ' . $this->venue[ 'venue_postal_code' ];

		header( "Content-Type: text/Calendar; charset=utf-8" );
		header( "Content-Disposition: inline; filename={$this->file_name}" );
		echo "BEGIN:VCALENDAR\n";
		echo "VERSION:2.0\n";
		echo "PRODID:-//theantichris.com//NONSGML {$this->event_name}//EN\n";
		echo "METHOD:REQUEST\n"; // Required by Outlook.
		echo "BEGIN:VEVENT\n";
		echo "UID:" . date( 'Ymd' ) . 'T' . date( 'His' ) . "-" . rand() . "-theantichris.com\n"; // Required by Outlook.
		echo "DTSTAMP:" . date( 'Ymd' ) . 'T' . date( 'His' ) . "\n"; // Required by Outlook.
		echo "DTSTART:{$start}\n";
		echo "DTEND:{$end}\n";
		echo "LOCATION:{$location}\n";
		echo "SUMMARY:{$this->event_name}\n";
		echo "DESCRIPTION: {$this->event_description}\n";
		echo "END:VEVENT\n";
		echo "END:VCALENDAR\n";
	}

}