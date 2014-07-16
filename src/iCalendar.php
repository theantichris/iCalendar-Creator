<?php

namespace theantichris\iCalendarCreator;

/**
 * Class iCalendar
 * @package theantichris\iCalendarCreator
 * @since 1.0.0
 */
class iCalendar
{
    /** @var string */
    private $eventName;
    /** @var string */
    private $eventDescription;
    /** @var \DateTime|null */
    private $eventStart;
    /** @var \DateTime|null */
    private $eventEnd;
    /** @var null|Location */
    private $eventLocation;
    /** @var string */
    private $organizerName;
    /** @var string */
    private $organizerEmail;

    /**
     * @since 1.0.0
     *
     * @param string $eventName
     * @param \DateTime|null $eventStart
     * @param \DateTime|null $eventEnd
     * @param string $eventDescription
     * @param Location|null $eventLocation
     * @param string $organizerName
     * @param string $organizerEmail
     */
    function __construct($eventName, \DateTime $eventStart, \DateTime $eventEnd, $eventDescription = '', Location $eventLocation = null, $organizerName = '', $organizerEmail = '')
    {
        $this->eventName        = $eventName;
        $this->eventDescription = $eventDescription;
        $this->eventStart       = $eventStart;
        $this->eventEnd         = $eventEnd;
        $this->eventLocation    = $eventLocation;
        $this->organizerName    = $organizerName;
        $this->organizerEmail   = $organizerEmail;
    }

    /**
     * @since 1.0.0
     *
     * @return string
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * @since 1.0.0
     *
     * @return string
     */
    public function getSlug()
    {
        return strtolower(str_replace(array(' ', "'", '.'), array('-', '', ''), $this->eventName));
    }

    /**
     * @since 1.0.0
     *
     * @return string
     */
    public function getEventDescription()
    {
        return $this->eventDescription;
    }

    /**
     * @since 1.0.0
     *
     * @return string
     */
    public function getEventStart()
    {
        $timestamp = $this->eventStart->getTimestamp() + $this->eventStart->getOffset();

        return date('Ymd', $timestamp . 'T' . date('His', $timestamp) . 'Z');
    }

    /**
     * @since 1.0.0
     *
     * @return string
     */
    public function getEventEnd()
    {
        $timestamp = $this->eventEnd->getTimestamp() + $this->eventEnd->getOffset();

        return date('Ymd', $timestamp . 'T' . date('His', $timestamp) . 'Z');
    }

    /**
     * @since 1.0.0
     *
     * @return string
     */
    public function getEventLocation()
    {
        return $this->eventLocation->__toString();
    }

    /**
     * @since 1.0.0
     *
     * @return string
     */
    public function getOrganizerName()
    {
        return $this->organizerName;
    }

    /**
     * @since 1.0.0
     *
     * @return string
     */
    public function getOrganizerEmail()
    {
        return $this->organizerEmail;
    }
}