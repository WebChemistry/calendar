<?php

declare(strict_types=1);

namespace WebChemistry\Calendar;

class CalendarHour {

	/** @var \DateTime */
	private $start;

	/** @var \DateTime */
	private $end;

	/** @var int */
	private $hour;

	/** @var CalendarEvent[] */
	private $events;

	public function __construct(\DateTime $start, array $events = []) {
		$this->hour = (int) $start->format('G');
		$this->start = $start;
		$this->start->setTime($this->hour, 0, 0);
		$this->end = clone $this->start;
		$this->end->setTime($this->hour, 59, 59);
		$this->events = $events;
	}

	/**
	 * @return \DateTime
	 */
	public function getStart(): \DateTime {
		return $this->start;
	}

	/**
	 * @return \DateTime
	 */
	public function getEnd(): \DateTime {
		return $this->end;
	}

	/**
	 * @return int
	 */
	public function toInt(): int {
		return $this->hour;
	}

	/**
	 * @return CalendarEvent[]
	 */
	public function getEvents(): array {
		return $this->events;
	}

}
