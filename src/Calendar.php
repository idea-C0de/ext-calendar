<?php
namespace Fisharebest\ExtCalendar;

use InvalidArgumentException;

/**
 * class Calendar - generic base class for specific calendars.
 *
 * @author    Greg Roach <fisharebest@gmail.com>
 * @copyright (c) 2014 Greg Roach
 * @license   This program is free software: you can redistribute it and/or modify
 *            it under the terms of the GNU General Public License as published by
 *            the Free Software Foundation, either version 3 of the License, or
 *            (at your option) any later version.
 *
 *            This program is distributed in the hope that it will be useful,
 *            but WITHOUT ANY WARRANTY; without even the implied warranty of
 *            MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *            GNU General Public License for more details.
 *
 *            You should have received a copy of the GNU General Public License
 *            along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
abstract class Calendar {
	/** See the GEDCOM specification */
	const GEDCOM_CALENDAR_ESCAPE = '@#DUNKNOWN@';

	/** The earliest Julian Day number that can be converted into this calendar. */
	const JD_START = 1;

	/** The latest Julian Day number that can be converted into this calendar. */
	const JD_END = 2147483647;

	/** The maximum number of months in any year */
	const MAX_MONTHS_IN_YEAR = 12;

	/** Does the calendar start at year 1, or are we allowed negative (BCE) years. */
	const NEGATIVE_YEARS_ALLOWED = false;

	/**
	 * Calculate the number of days in a month.
	 *
	 * @param  int $year
	 * @param  int $month
	 *
	 * @return int
	 *
	 * @throws InvalidArgumentException
	 */
	public function daysInMonth($year, $month) {
		if ($year == 0 || $year < 0 && !static::NEGATIVE_YEARS_ALLOWED) {
			throw new InvalidArgumentException('Year ' . $year . ' is invalid for this calendar');
		} elseif ($month < 1 || $month > static::MAX_MONTHS_IN_YEAR) {
			throw new InvalidArgumentException('Month ' . $month . ' is invalid for this calendar');
		} else {
			return static::$DAYS_IN_MONTH[$this->leapYear($year)][$month];
		}
	}
}
