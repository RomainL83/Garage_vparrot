<?php

namespace App\Entity;

use App\Repository\CompanyScheduleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyScheduleRepository::class)]
class CompanySchedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $day = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $startMorning = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $endMorning = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $startAfternoon = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endAfternoon = null;

    #[ORM\ManyToOne(inversedBy: 'companySchedules')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $company = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): static
    {
        $this->day = $day;

        return $this;
    }

    public function getStartMorning(): ?\DateTimeInterface
    {
        return $this->startMorning;
    }

    public function setStartMorning(\DateTimeInterface $startMorning): static
    {
        $this->startMorning = $startMorning;

        return $this;
    }

    public function getEndMorning(): ?\DateTimeInterface
    {
        return $this->endMorning;
    }

    public function setEndMorning(\DateTimeInterface $endMorning): static
    {
        $this->endMorning = $endMorning;

        return $this;
    }

    public function getStartAfternoon(): ?\DateTimeInterface
    {
        return $this->startAfternoon;
    }

    public function setStartAfternoon(\DateTimeInterface $startAfternoon): static
    {
        $this->startAfternoon = $startAfternoon;

        return $this;
    }

    public function getEndAfternoon(): ?\DateTimeInterface
    {
        return $this->endAfternoon;
    }

    public function setEndAfternoon(\DateTimeInterface $endAfternoon): static
    {
        $this->endAfternoon = $endAfternoon;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): static
    {
        $this->company = $company;

        return $this;
    }
}
