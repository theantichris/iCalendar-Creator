# iCalendar-Creator

Creates iCalendar (.ics) files.

## Getting Started

Include the package in your composer.json file.

    "require": {
            "theantichris/icalendar-creator": "*"
    },

## Classes

### Location

Stores and formats the output for the location part of the ICS file.

The constructor accepts name, address line 1, address line 2, city, state, and postal code as strings. Only name is required.

    new Location($name, $address1, $address2, $city, $state, $postalCode);

### iCalendar

Stores and outputs the needed information for the ICS file.

The constructor accepts event name (string), event start (DateTime), event end (DateTime), event description (string),
location (Location), organizer name (string), and organizer email (string). Only event name, event start, and event end
are required.

    new iCalendar($eventName, $eventStart, $eventEnd, $eventDescription, $eventLocation, $organizerName, $organizerEmail);

### iCalendarCreator

This class has two static method for creating and viewing an ICS file.

#### createIcsFile

This method generates an ICS file based on the iCalendar object passed in.

    iCalendarCreator::createIcsFile($iCalendar);

#### viewIcsFile

This method echoes the content of the ICS file.

    iCalendarCreator::viewIcsFile($iCalendar);

