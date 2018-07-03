<?php
namespace Silvesterk\BusinessDays;


class DateRange
{
    /**
     * @var \DateTime
     */
    private $from;

    /**
     * @var \DateTime
     */
    private $to;

    /**
     * DateRange constructor.
     * @param string $from
     * @param string $to
     */
    public function __construct(string $from, string $to)
    {
        $this->from = new \DateTime($from);
        $this->to = new \DateTime($to);
    }

    /**
     * @return \DateTime
     */
    public function getFrom() : \DateTime
    {
        return $this->from;
    }

    /**
     * @param \DateTime $from
     * @return DateRange
     */
    public function setFrom($from) : self
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTo() : \DateTime
    {
        return $this->to;
    }

    /**
     * @param \DateTime $to
     * @return DateRange
     */
    public function setTo($to) : self
    {
        $this->to = $to;
        return $this;
    }


}