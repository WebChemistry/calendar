<?php

declare(strict_types=1);

namespace WebChemistry\Calendar;

class CalendarEvent {

	/** @var \DateTime */
	private $date;

	/** @var array */
	private $data;

	public function __construct(\DateTime $date, array $data = []) {
		$this->date = $date;
		$this->data = $data;
	}

	/**
	 * @param int $year
	 * @param int $month
	 * @param int $day
	 * @param array $data
	 * @return CalendarEvent
	 */
	public static function createFromInt(int $year, int $month, int $day, array $data = []): self {
		$date = new \DateTime();
		$date->setDate($year, $month, $day);

		return new self($date, $data);
	}

	/**
	 * @return \DateTime
	 */
	public function getDate(): \DateTime {
		return $this->date;
	}

	/**
	 * @return array
	 */
	public function getData(): array {
		return $this->data;
	}

}
