<?php
namespace Silvesterk\Test;

use PHPUnit\Framework\TestCase;
use Silvesterk\BusinessDays\BusinessDays;
use Silvesterk\BusinessDays\DateRange;


class Test extends TestCase
{
    public function testCreateDateRange()
    {
        $dateRange = new DateRange('2002-01-01','2017-01-01');
        $dateFrom = $dateRange->getFrom();
        $dateTo = $dateRange->getTo();

        $this->assertInstanceOf(\DateTime::class, $dateFrom);
        $this->assertInstanceOf(\DateTime::class, $dateTo);
        $this->assertInstanceOf(DateRange::class, $dateRange);
        $this->assertEquals('2002-01-01',$dateFrom->format('Y-m-d'));
        $this->assertEquals('2017-01-01',$dateTo->format('Y-m-d'));

        return $dateRange;
    }

    /**
     * @depends testCreateDateRange
     * @param DateRange $dateRange
     */
    public function testGetBusinessDayNumberFromRange(DateRange $dateRange)
    {
        $businessDays = new BusinessDays();
        $days = $businessDays->getBusinessDayNumberFromRange($dateRange);
        // This is hardcoded it is 3903 days trust me
        $this->assertEquals(3903, $days);
    }

    public function testIsWeekend()
    {
        $businessDays = new BusinessDays();
        $weekendDay = new \DateTime('2018-06-03');
        $weekDay = new \DateTime('2018-06-04');

        $this->assertTrue($businessDays->isWeekend($weekendDay));
        $this->assertFalse($businessDays->isWeekend($weekDay));
    }

    public function testIsHoliday()
    {
        $businessDays = new BusinessDays();
        $today = new \DateTime();
        $holiday = new \DateTime('2016-01-01');
        $weekDay = new \DateTime('2018-06-03');
        // Add a holiday
        $businessDays->addHoliday($today);

        $this->assertTrue($businessDays->isHoliday($today));
        $this->assertTrue($businessDays->isHoliday($holiday));
        $this->assertFalse($businessDays->isHoliday($weekDay));
    }

}