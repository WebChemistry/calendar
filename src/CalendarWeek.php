<?php

declare(strict_types=1);

namespace WebChemistry\Calendar;

class CalendarWeek {

	/** @var \DateTime */
	private $start;

	/** @var \DateTime */
	private $end;

	/** @var CalendarEvents */
	private $events;

	public function __construct(\DateTime $date) {
		Utils::startOfWeek($date);
		$this->start = $date;
		$this->end = (clone $date)->modify('+ 6 days');
		Utils::endOfDay($this->end);
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
	 * @param CalendarEvents $events
	 */
	public function setEvents(CalendarEvents $events): void {
		$this->events = $events;
	}

	/**
	 * @return CalendarDay[]
	 */
	public function getDays(): array {
		$period = new \DatePeriod($this->start, new \DateInterval('P1D'), $this->end);

		$arr = [];
		foreach ($period as $day) {
			$calendar = new CalendarDay($day);

			if ($this->events) {
				$calendar->setEvents($this->events);
			}

			$arr[] = $calendar;
		}

		return $arr;
	}

}
