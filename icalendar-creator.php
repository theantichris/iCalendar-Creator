<?php
/**
 * iCalendarCreator class file.
 *
 * @package iCalendarCreator
 * @since 1.0.0
 */

/**
 * Class iCalendarCreator
 */
class iCalendarCreator {
	private $event_id;
	private $file_name;
	private $event_name;
	private $event_description;
	private $event_start;
	private $event_end;
	private $event_venue = array(
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
	 * If the event ID exists and is an integer a new object will be created.
	 *
	 * @since 1.0.0
	 *
	 * @param $event_id
	 * return void
	 */
	public function __construct( $event_id ) {
		if ( ( !$event_id ) || ( !is_numeric( $event_id ) ) ) {
			die();
		} else {
			$this->event_id = $event_id;
		}
	}
}