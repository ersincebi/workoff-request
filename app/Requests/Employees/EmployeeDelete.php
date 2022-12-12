<?php

namespace App\Requests\Employees;

class EmployeeDelete
{
    /**
     * @var string|null
     */
    private ?string $tcNo;

    public function __construct(string $tcNo = null)
    {
        $this->tcNo = $tcNo;
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
}

