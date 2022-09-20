<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\LineupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LineupRepository::class)]
#[ApiResource]
class Lineup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $formation = null;

    #[ORM\ManyToOne(inversedBy: 'lineups')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $game = null;

    #[ORM\ManyToOne(inversedBy: 'lineups')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $team = null;

    #[ORM\OneToMany(mappedBy: 'lineup', targetEntity: PlayerPosition::class)]
    private Collection $playerPositions;

    public function __construct()
    {
        $this->playerPositions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormation(): ?string
    {
        return $this->formation;
    }

    public function setFormation(string $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

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
            $playerPosition->setLineup($this);
        }

        return $this;
    }

    public function removePlayerPosition(PlayerPosition $playerPosition): self
    {
        if ($this->playerPositions->removeElement($playerPosition)) {
            // set the owning side to null (unless already changed)
            if ($playerPosition->getLineup() === $this) {
                $playerPosition->setLineup(null);
            }
        }

        return $this;
    }
}
