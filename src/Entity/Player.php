<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PlayerRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
#[ApiResource]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $apiId = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $age = null;

    #[ORM\Column(nullable: true)]
    private ?int $number = null;

    #[ORM\Column(length: 255)]
    private ?string $position = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nationality = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastName = null;

    #[ORM\Column(nullable: true)]
    private ?bool $injured = null;

    #[ORM\ManyToOne(inversedBy: 'players')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $team = null;

    #[ORM\OneToMany(mappedBy: 'player', targetEntity: PlayerStat::class)]
    private Collection $playerStats;

    #[ORM\OneToMany(mappedBy: 'player', targetEntity: PlayerPosition::class)]
    private Collection $playerPositions;

    #[ORM\OneToMany(mappedBy: 'player', targetEntity: Event::class)]
    private Collection $events;

    #[ORM\OneToMany(mappedBy: 'playerAssist', targetEntity: Event::class)]
    private Collection $eventsAssists;

    #[ORM\Column]
    private ?DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->playerStats = new ArrayCollection();
        $this->playerPositions = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->eventsAssists = new ArrayCollection();
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): self
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

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(?string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function isInjured(): ?bool
    {
        return $this->injured;
    }

    public function setInjured(?bool $injured): self
    {
        $this->injured = $injured;

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

    /**
     * @return Collection<int, PlayerStat>
     */
    public function getPlayerStats(): Collection
    {
        return $this->playerStats;
    }

    public function addPlayerStat(PlayerStat $playerStat): self
    {
        if (!$this->playerStats->contains($playerStat)) {
            $this->playerStats->add($playerStat);
            $playerStat->setPlayer($this);
        }

        return $this;
    }

    public function removePlayerStat(PlayerStat $playerStat): self
    {
        if ($this->playerStats->removeElement($playerStat)) {
            // set the owning side to null (unless already changed)
            if ($playerStat->getPlayer() === $this) {
                $playerStat->setPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlayerPosition>
     */
    public function getPlayerPositions(): Collection
    {
        return $this->playerPositions;
    }

    public function addPlayerPosition(PlayerPosition $playerPosition): self
    {
        if (!$this->playerPositions->contains($playerPosition)) {
            $this->playerPositions->add($playerPosition);
            $playerPosition->setPlayer($this);
        }

        return $this;
    }

    public function removePlayerPosition(PlayerPosition $playerPosition): self
    {
        if ($this->playerPositions->removeElement($playerPosition)) {
            // set the owning side to null (unless already changed)
            if ($playerPosition->getPlayer() === $this) {
                $playerPosition->setPlayer(null);
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
            $event->setPlayer($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getPlayer() === $this) {
                $event->setPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEventsAssists(): Collection
    {
        return $this->eventsAssists;
    }

    public function addEventAssist(Event $eventAssist): self
    {
        if (!$this->eventsAssists->contains($eventAssist)) {
            $this->eventsAssists->add($eventAssist);
            $eventAssist->setPlayer($this);
        }

        return $this;
    }

    public function removeEventAssist(Event $eventAssist): self
    {
        if ($this->eventsAssists->removeElement($eventAssist)) {
            // set the owning side to null (unless already changed)
            if ($eventAssist->getPlayer() === $this) {
                $eventAssist->setPlayer(null);
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
