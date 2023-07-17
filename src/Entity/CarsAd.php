<?php

namespace App\Entity;

use App\Repository\CarsAdRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

#[ORM\Entity(repositoryClass: CarsAdRepository::class)]

class CarsAd extends AbstractDashboardController
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column]
    private ?int $manufactureYear = null;

    #[ORM\Column]
    private ?int $milage = null;

    #[ORM\Column(nullable: true)]
    private ?array $pictures = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 50)]
    private ?string $title_ad = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_publication = null;

    #[ORM\Column(length: 255)]
    private ?string $ad_illustration = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getManufactureYear(): ?int
    {
        return $this->manufactureYear;
    }

    public function setManufactureYear(int $manufactureYear): static
    {
        $this->manufactureYear = $manufactureYear;

        return $this;
    }

    public function getMilage(): ?int
    {
        return $this->milage;
    }

    public function setMilage(int $milage): static
    {
        $this->milage = $milage;

        return $this;
    }

    public function getPictures(): ?array
    {
        return $this->pictures;
    }

    public function setPictures(?array $pictures): static
    {
        $this->pictures = $pictures;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTitleAd(): ?string
    {
        return $this->title_ad;
    }

    public function setTitleAd(string $title_ad): static
    {
        $this->title_ad = $title_ad;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->date_publication;
    }

    public function setDatePublication(?\DateTimeInterface $date_publication): static
    {
        $this->date_publication = $date_publication;

        return $this;
    }

    public function getAdIllustration(): ?string
    {
        return $this->ad_illustration;
    }

    public function setAdIllustration(string $ad_illustration): static
    {
        $this->ad_illustration = $ad_illustration;

        return $this;
    }
}
