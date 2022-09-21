<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PlayerStatRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerStatRepository::class)]
#[ApiResource]
class PlayerStat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'playerStats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Player $player = null;

    #[ORM\Column]
    private ?int $goals = null;

    #[ORM\Column]
    private ?int $goalsAssists = null;

    #[ORM\Column]
    private ?int $goalsConceded = null;

    #[ORM\Column]
    private ?int $passes = null;

    #[ORM\Column]
    private ?int $passesAccuracy = null;

    #[ORM\Column]
    private ?int $shots = null;

    #[ORM\Column]
    private ?int $shotsOn = null;

    #[ORM\Column]
    private ?int $cardYellow = null;

    #[ORM\Column]
    private ?int $cardRed = null;

    #[ORM\Column]
    private ?int $games = null;

    #[ORM\Column]
    private ?int $titu = null;

    #[ORM\Column]
    private ?int $penaltyOn = null;

    #[ORM\Column]
    private ?int $penaltyOut = null;

    #[ORM\Column]
    private ?int $minutesPlayed = null;

    #[ORM\ManyToOne(inversedBy: 'playerStats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?League $league = null;

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

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getGoals(): ?int
    {
        return $this->goals;
    }

    public function setGoals(int $goals): self
    {
        $this->goals = $goals;

        return $this;
    }

    public function getGoalsAssists(): ?int
    {
        return $this->goalsAssists;
    }

    public function setGoalsAssists(int $goalsAssists): self
    {
        $this->goalsAssists = $goalsAssists;

        return $this;
    }

    public function getGoalsConceded(): ?int
    {
        return $this->goalsConceded;
    }

    public function setGoalsConceded(int $goalsConceded): self
    {
        $this->goalsConceded = $goalsConceded;

        return $this;
    }

    public function getPasses(): ?int
    {
        return $this->passes;
    }

    public function setPasses(int $passes): self
    {
        $this->passes = $passes;

        return $this;
    }

    public function getPassesAccuracy(): ?int
    {
        return $this->passesAccuracy;
    }

    public function setPassesAccuracy(int $passesAccuracy): self
    {
        $this->passesAccuracy = $passesAccuracy;

        return $this;
    }

    public function getShots(): ?int
    {
        return $this->shots;
    }

    public function setShots(int $shots): self
    {
        $this->shots = $shots;

        return $this;
    }

    public function getShotsOn(): ?int
    {
        return $this->shotsOn;
    }

    public function setShotsOn(int $shotsOn): self
    {
        $this->shotsOn = $shotsOn;

        return $this;
    }

    public function getCardYellow(): ?int
    {
        return $this->cardYellow;
    }

    public function setCardYellow(int $cardYellow): self
    {
        $this->cardYellow = $cardYellow;

        return $this;
    }

    public function getCardRed(): ?int
    {
        return $this->cardRed;
    }

    public function setCardRed(int $cardRed): self
    {
        $this->cardRed = $cardRed;

        return $this;
    }

    public function getGames(): ?int
    {
        return $this->games;
    }

    public function setGames(int $games): self
    {
        $this->games = $games;

        return $this;
    }

    public function getTitu(): ?int
    {
        return $this->titu;
    }

    public function setTitu(int $titu): self
    {
        $this->titu = $titu;

        return $this;
    }

    public function getPenaltyOn(): ?int
    {
        return $this->penaltyOn;
    }

    public function setPenaltyOn(int $penaltyOn): self
    {
        $this->penaltyOn = $penaltyOn;

        return $this;
    }

    public function getPenaltyOut(): ?int
    {
        return $this->penaltyOut;
    }

    public function setPenaltyOut(int $penaltyOut): self
    {
        $this->penaltyOut = $penaltyOut;

        return $this;
    }

    public function getMinutesPlayed(): ?int
    {
        return $this->minutesPlayed;
    }

    public function setMinutesPlayed(int $minutesPlayed): self
    {
        $this->minutesPlayed = $minutesPlayed;

        return $this;
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
