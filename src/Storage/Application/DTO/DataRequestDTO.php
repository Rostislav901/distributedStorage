<?php

namespace App\Storage\Application\DTO;

use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class DataRequestDTO
{
    #[NotBlank]
    #[Length(min: 3, max: 23)]
    public string $title;
    #[NotBlank]
    #[Length(min: 3, max: 23)]
    public string $description;
    #[NotBlank]
    #[Length(min: 3, max: 23)]
    public string $location;
    #[DateTime(format: 'Y-m-d')]
    public string $startTime;
    #[DateTime(format: 'Y-m-d')]
    public string $endTime;

    public function __construct(string $title, string $description, string $location, string $startTime, string $endTime)
    {
        $this->title = $title;
        $this->description = $description;
        $this->location = $location;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    public function getStartTimeValue(): \DateTime
    {
        return \DateTime::createFromFormat('Y-m-d', $this->startTime);
    }

    public function getEndTimeValue(): \DateTime
    {
        return \DateTime::createFromFormat('Y-m-d', $this->endTime);
    }
}
