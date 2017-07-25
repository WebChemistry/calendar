<?php

declare(strict_types=1);

namespace WebChemistry\Calendar;

class CalendarDay {

	/** @var \DateTime */
	private $start;

	/** @var \DateTime */
	private $end;

	/** @var CalendarEvents */
	private $events;

	public function __construct(\DateTime $start) {
		Utils::resetTime($start);
		$this->start = $start;
		$this->end = (clone $start);
		Utils::endOfDay($this->end);
	}

	/**
	 * @param CalendarEvents $events
	 */
	public function setEvents(CalendarEvents $events): void {
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
		return (int) $this->start->format('j');
	}

	/**
	 * @return CalendarHour[]
	 */
	public function getHours(): \Generator {
		$end = (clone $this->start)->modify('+ 1 day');
		$period = new \DatePeriod($this->start, new \DateInterval('PT1H'), $end);

		$events = $this->getHourEvents();
		/** @var \DateTime $item */
		foreach ($period as $item) {
			$calendar = new CalendarHour($item, isset($events[$item->format('G')]) ? $events[$item->format('G')] : []);

			yield $calendar;
		}
	}

	protected function getHourEvents(): array {
		$arr = [];
		foreach ($this->getEvents() as $event) {
			$arr[$event->getDate()->format('G')][] = $event;
		}

		return $arr;
	}

	/**
	 * @return CalendarEvent[]
	 */
	public function getEvents(): array {
		if (!$this->events) {
			return [];
		}

		return $this->events->get($this->start);
	}

	/**
	 * @param int $year
	 * @param int $month
	 * @param int $day
	 * @return CalendarDay
	 */
	public static function createFormInt(int $year, int $month, int $day): self {
		$date = new \DateTime();
		$date->setDate($year, $month, $day);

		return new self($date);
	}

}
