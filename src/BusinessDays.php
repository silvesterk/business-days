<?php

namespace Silvesterk\BusinessDays;

class BusinessDays
{
    const SATURDAY = 6;

    const SUNDAY = 7;

    // Holidays in Serbia
    const HOLIDAY_STRINGS = array(
        '2016-01-01',
        '2016-01-04',
        '2016-01-05',
        '2016-01-06',
        '2016-01-07',
        '2016-01-08',
        '2016-02-15',
        '2016-02-16',
        '2016-04-29',
        '2016-05-01',
        '2016-05-02',
        '2016-05-03',
        '2016-11-11',
        '2018-01-01',
        '2018-01-02',
        '2018-02-15',
        '2018-02-16',
        '2018-04-06',
        '2018-04-09',
        '2018-05-01',
        '2018-05-02',
        '2019-01-01',
        '2019-01-02',
        '2019-01-07',
        '2019-02-15',
        '2019-02-16',
        '2019-04-26',
        '2019-04-27',
        '2019-04-28',
        '2019-04-29',
        '2019-05-01',
        '2019-05-02',
        '2019-11-11',
    );

    /**
     * @var \DateTime[]
     */
    private $holidays = [];

    /**
     * BusinessDays constructor.
     */
    public function __construct()
    {
        foreach (self::HOLIDAY_STRINGS as $holidayString) {
            $this->holidays[$holidayString] = new \DateTime($holidayString);
        }
    }

    /**
     * @param DateRange $dateRange
     * @return int
     */
    public function getBusinessDayNumberFromRange(DateRange $dateRange)
    {
        $startDate = $dateRange->getFrom();
        $endDate = $dateRange->getTo()->modify('+1 day');

        $dayDifference = $startDate->diff($endDate)->days;

        $weekDifference = floor($dayDifference / 7);
        $numberOfRemainingDays = fmod($dayDifference, 7);

        $firstDayOfWeek = $startDate->format('N');
        $lastDayOfWeek = $endDate->format('N');
        // The two can be equal in leap years when february has 29 days, the equal sign is added here
        // In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
        if (($firstDayOfWeek <= $lastDayOfWeek && $firstDayOfWeek <= self::SUNDAY && $lastDayOfWeek >= self::SUNDAY)
            || $firstDayOfWeek === self::SUNDAY) {
            $numberOfRemainingDays--;
        } else {
            $numberOfRemainingDays -= 2;
        }

        // The number of business days is, the number of weeks between two dates * 5 working days + the remainder
        $businessDays = ($weekDifference * 5) + ($numberOfRemainingDays > 0 ? $numberOfRemainingDays : 0);

        // Remove the holidays
        foreach ($this->holidays as $holiday) {
            // Check if the holiday is between the two dates and if the holiday doesn't fall in weekend
            if ($startDate <= $holiday && $endDate >= $holiday && !$this->isWeekend($holiday)) {
                $businessDays--;
            }
        }

        return (int)$businessDays;
    }

    /**
     * @param \DateTime $dateTime
     * @return bool
     */
    public function isBusinessDay(\DateTime $dateTime)
    {
        return !$this->isHoliday($dateTime) && !$this->isWeekend($dateTime);
    }

    /**
     * @param \DateTime $dateTime
     * @return bool
     */
    public function isWeekend(\DateTime $dateTime)
    {
        return $dateTime->format('N') >= self::SATURDAY;
    }

    /**
     * @param \DateTime $dateTime
     * @return bool
     */
    public function isHoliday(\DateTime $dateTime)
    {
        return array_key_exists($dateTime->format('Y-m-d'),$this->holidays);
    }

    /**
     * @return \DateTime[]
     */
    public function getHolidays()
    {
        return $this->holidays;
    }

    /**
     * @param \DateTime $dateTime
     */
    public function addHoliday(\DateTime $dateTime)
    {
        $this->holidays[$dateTime->format('Y-m-d')] = $dateTime;
    }
}
