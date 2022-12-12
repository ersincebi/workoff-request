<?php

namespace App\Requests\Workoffs;

class WorkoffsRequest
{
    /**
     * @var string|null
     */
    private ?string $tcNo;

    /**
     * @var string|null
     */
    private ?string $beginDate;

    /**
     * @var string|null
     */
    private ?string $endDate;

    public function __construct(string $tcNo = null, string $beginDate = null, string $endDate = null)
    {
        $this->tcNo = $tcNo;
        $this->beginDate = $beginDate;
        $this->endDate = $endDate;
    }

    /**
     * Get the value of tcNo
     *
     * @return  string|null
     */
    final public function getTcNo(): ?string
    {
        return $this->tcNo;
    }

    /**
     * Get the value of beginDate
     *
     * @return  string|null
     */
    final public function getBeginDate(): ?string
    {
        return $this->beginDate;
    }

    /**
     * Get the value of endDate
     *
     * @return  string|null
     */
    final public function getEndDate(): ?string
    {
        return $this->endDate;
    }
}
