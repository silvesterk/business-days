# Business days
A simple helper PHP library used for calculating business days, 

## Installation
``
composer require silvesterk/business-days
``
## Classes
### BusinessDays
#### getBusinessDayNumberFromRange
```
    /**
     * @param DateRange $dateRange
     * @return int
     */
    public function getBusinessDayNumberFromRange(DateRange $dateRange)
```
Method that takes in a date range and returns the number of business or work days between those two dates (+1)
##### Example
```
$bizDays = new BusinessDays();
$dateRange = new DateRange('yesterday','today');
$businessDays = $bizDays->getBusinessDayNumberFromRange($dateRange);
```
#### isBusinessDay
```
    /**
     * @param \DateTime $dateTime
     * @return bool
     */
    public function isBusinessDay(\DateTime $dateTime)
```
Returns true if the provided date is a business day.
##### Example
```
$isTodayABizDay = $bizDays->isBusinessDay(new \DateTime());
```
#### isWeekend
```
    /**
     * @param \DateTime $dateTime
     * @return bool
     */
    public function isWeekend(\DateTime $dateTime)
```
Returns true if the provided date is a weekend day.
##### Example
```
$isItWeekend = $bizDays->isWeekend(new \DateTime());
```
#### isHoliday
```
    /**
     * @param \DateTime $dateTime
     * @return bool
     */
    public function isHoliday(\DateTime $dateTime)
```
Returns true if the provided date is a holiday.
##### Example
```
$isItAHoliday = $bizDays->isHoliday(new \DateTime());
```
#### getHolidays
Returns the list of holidays
#### addHoliday
```
    /**
     * @param \DateTime $dateTime
     */
    public function addHoliday(\DateTime $dateTime)
```
Adds a holiday to the holiday list
##### Example
Add today as a holiday (the current instantiation of the class will not count today as a business day).
```
$bizDays->addHoliday(new \DateTime());
```
### DateRange
A simple helper class used for defining two date times (from, to)





