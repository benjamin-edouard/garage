<?php

namespace App\Entity;

use App\Repository\HoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

#[ORM\Entity(repositoryClass: HoursRepository::class)]
class Hours extends AbstractDashboardController
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $day_of_week = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $open_am = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $close_am = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $open_pm = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $close_pm = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDayOfWeek(): ?string
    {
        return $this->day_of_week;
    }

    public function setDayOfWeek(string $day_of_week): static
    {
        $this->day_of_week = $day_of_week;

        return $this;
    }

    public function getOpenAm(): ?\DateTimeInterface
    {
        return $this->open_am;
    }

    public function setOpenAm(\DateTimeInterface $open_am): static
    {
        $this->open_am = $open_am;

        return $this;
    }

    public function getCloseAm(): ?\DateTimeInterface
    {
        return $this->close_am;
    }

    public function setCloseAm(\DateTimeInterface $close_am): static
    {
        $this->close_am = $close_am;

        return $this;
    }

    public function getOpenPm(): ?\DateTimeInterface
    {
        return $this->open_pm;
    }

    public function setOpenPm(\DateTimeInterface $open_pm): static
    {
        $this->open_pm = $open_pm;

        return $this;
    }

    public function getClosePm(): ?\DateTimeInterface
    {
        return $this->close_pm;
    }

    public function setClosePm(\DateTimeInterface $close_pm): static
    {
        $this->close_pm = $close_pm;

        return $this;
    }
}
