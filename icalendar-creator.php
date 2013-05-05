<?php
/**
 * iCalendarCreator class file.
 *
 * @package iCalendarCreator
 * @version 1.0.0
 */

/**
 * Class iCalendarCreator
 *
 * @since 1.0.0
 */
class iCalendarCreator {
	private $event_id;
	private $file_name;
	private $event_name;
	private $event_description;
	private $time_zone;
	private $event_start;
	private $event_end;
	private $venue = array(
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
			$this->file_name = $event_name . 'ics';
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

}