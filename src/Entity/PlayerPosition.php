<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PlayerPositionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerPositionRepository::class)]
#[ApiResource]
class PlayerPosition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column(length: 255)]
    private ?string $position = null;

    #[ORM\Column(length: 255)]
    private ?string $grid = null;

    #[ORM\Column]
    private ?bool $isStarter = null;

    #[ORM\ManyToOne(inversedBy: 'playerPositions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Player $player = null;

    #[ORM\ManyToOne(inversedBy: 'playerPositions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Lineup $lineup = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getGrid(): ?string
    {
        return $this->grid;
    }

    public function setGrid(string $grid): self
    {
        $this->grid = $grid;

        return $this;
    }

    public function isIsStarter(): ?bool
    {
        return $this->isStarter;
    }

    public function setIsStarter(bool $isStarter): self
    {
        $this->isStarter = $isStarter;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getLineup(): ?Lineup
    {
        return $this->lineup;
    }

    public function setLineup(?Lineup $lineup): self
    {
        $this->lineup = $lineup;

        return $this;
    }
}
