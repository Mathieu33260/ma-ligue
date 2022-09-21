<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\GameRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
#[ApiResource]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $apiId = null;

    #[ORM\Column]
    private ?DateTimeImmutable $date = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Stadium $stadium = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?int $elapsed = null;

    #[ORM\Column(length: 255)]
    private ?string $referee = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?League $league = null;

    #[ORM\ManyToOne(inversedBy: 'gamesHome')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $hometeam = null;

    #[ORM\ManyToOne(inversedBy: 'gamesAway')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $awayteam = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Round $round = null;

    #[ORM\Column]
    private ?int $goalsHometeam = null;

    #[ORM\Column]
    private ?int $goalsAwayteam = null;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Lineup::class)]
    private Collection $lineups;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: GameStat::class)]
    private Collection $gameStats;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Event::class)]
    private Collection $events;

    #[ORM\Column]
    private ?DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->lineups = new ArrayCollection();
        $this->gameStats = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApiId(): ?int
    {
        return $this->apiId;
    }

    public function setApiId(int $apiId): self
    {
        $this->apiId = $apiId;

        return $this;
    }

    public function getDate(): ?DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStadium(): ?Stadium
    {
        return $this->stadium;
    }

    public function setStadium(?Stadium $stadium): self
    {
        $this->stadium = $stadium;

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

    public function getElapsed(): ?int
    {
        return $this->elapsed;
    }

    public function setElapsed(int $elapsed): self
    {
        $this->elapsed = $elapsed;

        return $this;
    }

    public function getReferee(): ?string
    {
        return $this->referee;
    }

    public function setReferee(string $referee): self
    {
        $this->referee = $referee;

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

    public function getHometeam(): ?Team
    {
        return $this->hometeam;
    }

    public function setHometeam(?Team $hometeam): self
    {
        $this->hometeam = $hometeam;

        return $this;
    }

    public function getAwayteam(): ?Team
    {
        return $this->awayteam;
    }

    public function setAwayteam(?Team $awayteam): self
    {
        $this->awayteam = $awayteam;

        return $this;
    }

    public function getRound(): ?Round
    {
        return $this->round;
    }

    public function setRound(?Round $round): self
    {
        $this->round = $round;

        return $this;
    }

    public function getGoalsHometeam(): ?int
    {
        return $this->goalsHometeam;
    }

    public function setGoalsHometeam(int $goalsHometeam): self
    {
        $this->goalsHometeam = $goalsHometeam;

        return $this;
    }

    public function getGoalsAwayteam(): ?int
    {
        return $this->goalsAwayteam;
    }

    public function setGoalsAwayteam(int $goalsAwayteam): self
    {
        $this->goalsAwayteam = $goalsAwayteam;

        return $this;
    }

    /**
     * @return Collection<int, Lineup>
     */
    public function getLineups(): Collection
    {
        return $this->lineups;
    }

    public function addLineup(Lineup $lineup): self
    {
        if (!$this->lineups->contains($lineup)) {
            $this->lineups->add($lineup);
            $lineup->setGame($this);
        }

        return $this;
    }

    public function removeLineup(Lineup $lineup): self
    {
        if ($this->lineups->removeElement($lineup)) {
            // set the owning side to null (unless already changed)
            if ($lineup->getGame() === $this) {
                $lineup->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GameStat>
     */
    public function getGameStats(): Collection
    {
        return $this->gameStats;
    }

    public function addGameStat(GameStat $gameStat): self
    {
        if (!$this->gameStats->contains($gameStat)) {
            $this->gameStats->add($gameStat);
            $gameStat->setGame($this);
        }

        return $this;
    }

    public function removeGameStat(GameStat $gameStat): self
    {
        if ($this->gameStats->removeElement($gameStat)) {
            // set the owning side to null (unless already changed)
            if ($gameStat->getGame() === $this) {
                $gameStat->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setGame($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getGame() === $this) {
                $event->setGame(null);
            }
        }

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
