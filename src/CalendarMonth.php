<?php

declare(strict_types=1);

namespace WebChemistry\Calendar;

class CalendarMonth {

	/** @var \DateTime */
	private $start;

	/** @var \DateTime */
	private $end;

	/** @var CalendarEvents */
	private $events;

	public function __construct(\DateTime $start) {
		$this->start = $start;
		$this->end = clone $start;

		// start month
		Utils::resetTime($this->start);
		Utils::startOfWeek($this->start);

		// end month
		Utils::endOfDay($this->end);
		$this->end->modify('+ 1 month');
		$this->end->modify('+ ' . (7 - $this->end->format('N')) . ' days');
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
	public function getEnd() {
		return $this->end;
	}

	/**
	 * @param CalendarEvents $events
	 */
	public function setEvents(CalendarEvents $events): void {
		$this->events = $events;
	}

	/**
	 * @param int $year
	 * @param int $month
	 * @return CalendarMonth
	 */
	public static function createFromInt(int $year, int $month): self {
		return new self((new \DateTime())->setDate($year, $month, 1));
	}

	/**
	 * @return int
	 */
	public function toInt(): int {
		return (int) $this->start->format('n');
	}

	/**
	 * @return CalendarWeek[]
	 */
	public function getWeeks(): \Generator {
		$period = new \DatePeriod($this->start, new \DateInterval('P1W'), $this->end);

		foreach ($period as $week) {
			$calendar = new CalendarWeek($week);

			if ($this->events) {
				$calendar->setEvents($this->events);
			}

			yield $calendar;
		}
	}

}
