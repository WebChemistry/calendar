<?php

declare(strict_types=1);

namespace WebChemistry\Calendar;

class Utils {

	public static function startOfWeek(\DateTime $date): void {
		$date->modify('-' . ((int) $date->format('w') - 1) . ' days');
	}

	public static function resetTime(\DateTime $date): void {
		$date->setTime(0, 0, 0, 0);
	}

	public static function endOfDay(\DateTime $date): void {
		$date->setTime(23, 59, 59);
	}

	public static function daysInMonth(\DateTime $date): int {
		return (int) $date->format('t');
	}

}
