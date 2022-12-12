<?php

namespace App\Requests\Employees;

class EmployeeAddOrUpdate
{
    /**
     * @var string|null
     */
    private ?string $tcNo;

    /**
     * @var string|null
     */
    private ?string $sgkNo;

    /**
     * @var string|null
     */
    private ?string $name;

    /**
     * @var string|null
     */
    private ?string $surname;

    /**
     * @var string|null
     */
    private ?string $beginDate;

    /**
     * @var string|null
     */
    private ?string $quitDate;

    public function __construct(string $tcNo = null, string $sgkNo = null, string $name = null, string $surname = null, string $beginDate = null, string $quitDate = null)
    {
        $this->tcNo = $tcNo;
        $this->sgkNo = $sgkNo;
        $this->name = $name;
        $this->surname = $surname;
        $this->beginDate = $beginDate;
        $this->quitDate = $quitDate;
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
     * Get the value of sgkNo
     *
     * @return  string|null
     */
    final public function getSgkNo(): ?string
    {
        return $this->sgkNo;
    }

    /**
     * Get the value of name
     *
     * @return  string|null
     */
    final public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Get the value of surname
     *
     * @return  string|null
     */
    final public function getSurname(): ?string
    {
        return $this->surname;
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
     * Get the value of quitDate
     *
     * @return  string|null
     */
    final public function getQuitDate(): ?string
    {
        return $this->quitDate;
    }
}

