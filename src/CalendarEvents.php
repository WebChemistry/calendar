<?php

declare(strict_types=1);

namespace WebChemistry\Calendar;

class CalendarEvents {

	private const KEY_FORMAT = 'y-m-d';

	/** @var array */
	private $events = [];

	/**
	 * @param CalendarEvent $event
	 */
	public function addEvent(CalendarEvent $event) {
		$this->events[$this->getKey($event->getDate())][] = $event;
	}

	/**
	 * @param \DateTime $date
	 * @return string
	 */
	protected function getKey(\DateTime $date): string {
		return $date->format(self::KEY_FORMAT);
	}

	/**
	 * @param \DateTime $date
	 * @return CalendarEvent[]
	 */
	public function get(\DateTime $date): array {
		$key = $this->getKey($date);

		return isset($this->events[$key]) ? $this->events[$key] : [];
	}

}
