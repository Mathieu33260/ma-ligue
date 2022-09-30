<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\StandingRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StandingRepository::class)]
#[ApiResource]
class Standing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'standings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?League $league = null;

    #[ORM\Column]
    private ?int $points = null;

    #[ORM\Column]
    private ?int $goalsDiff = null;

    #[ORM\Column]
    private ?int $rank = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $form = null;

    #[ORM\ManyToOne(inversedBy: 'standings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $team = null;

    #[ORM\Column]
    private ?int $matchsPlayed = null;

    #[ORM\Column]
    private ?int $wins = null;

    #[ORM\Column]
    private ?int $loses = null;

    #[ORM\Column]
    private ?int $draws = null;

    #[ORM\Column]
    private ?int $goalsFor = null;

    #[ORM\Column]
    private ?int $goalsAgainst = null;

    #[ORM\Column]
    private ?DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLeague(): ?League
    {
        return $this->league;
    }

    public function setLeague(?League $league): self
    {
        $this->league = $league;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getGoalsDiff(): ?int
    {
        return $this->goalsDiff;
    }

    public function setGoalsDiff(int $goalsDiff): self
    {
        $this->goalsDiff = $goalsDiff;

        return $this;
    }

    public function getRank(): ?int
    {
        return $this->rank;
    }

    public function setRank(int $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getForm(): ?string
    {
        return $this->form;
    }

    public function setForm(string $form): self
    {
        $this->form = $form;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function getMatchsPlayed(): ?int
    {
        return $this->matchsPlayed;
    }

    public function setMatchsPlayed(int $matchsPlayed): self
    {
        $this->matchsPlayed = $matchsPlayed;

        return $this;
    }

    public function getWins(): ?int
    {
        return $this->wins;
    }

    public function setWins(int $wins): self
    {
        $this->wins = $wins;

        return $this;
    }

    public function getLoses(): ?int
    {
        return $this->loses;
    }

    public function setLoses(int $loses): self
    {
        $this->loses = $loses;

        return $this;
    }

    public function getDraws(): ?int
    {
        return $this->draws;
    }

    public function setDraws(int $draws): self
    {
        $this->draws = $draws;

        return $this;
    }

    public function getGoalsFor(): ?int
    {
        return $this->goalsFor;
    }

    public function setGoalsFor(int $goalsFor): self
    {
        $this->goalsFor = $goalsFor;

        return $this;
    }

    public function getGoalsAgainst(): ?int
    {
        return $this->goalsAgainst;
    }

    public function setGoalsAgainst(int $goalsAgainst): self
    {
        $this->goalsAgainst = $goalsAgainst;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
