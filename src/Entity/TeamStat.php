<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TeamStatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamStatRepository::class)]
#[ApiResource]
class TeamStat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'teamStats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $team = null;

    #[ORM\ManyToOne(inversedBy: 'teamStats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?League $league = null;

    #[ORM\Column]
    private ?int $winsHome = null;

    #[ORM\Column]
    private ?int $winsAway = null;

    #[ORM\Column]
    private ?int $losesHome = null;

    #[ORM\Column]
    private ?int $losesAway = null;

    #[ORM\Column]
    private ?int $drawsHome = null;

    #[ORM\Column]
    private ?int $drawsAway = null;

    #[ORM\Column]
    private ?int $goalsForHome = null;

    #[ORM\Column]
    private ?int $goalsForAway = null;

    #[ORM\Column]
    private ?int $goalsAgainstHome = null;

    #[ORM\Column]
    private ?int $goalsAgainstAway = null;

    #[ORM\Column]
    private ?int $redCard = null;

    #[ORM\Column]
    private ?int $yellowCard = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLeague(): ?League
    {
        return $this->league;
    }

    public function setLeague(?League $league): self
    {
        $this->league = $league;

        return $this;
    }

    public function getWinsHome(): ?int
    {
        return $this->winsHome;
    }

    public function setWinsHome(int $winsHome): self
    {
        $this->winsHome = $winsHome;

        return $this;
    }

    public function getWinsAway(): ?int
    {
        return $this->winsAway;
    }

    public function setWinsAway(int $winsAway): self
    {
        $this->winsAway = $winsAway;

        return $this;
    }

    public function getLosesHome(): ?int
    {
        return $this->losesHome;
    }

    public function setLosesHome(int $losesHome): self
    {
        $this->losesHome = $losesHome;

        return $this;
    }

    public function getLosesAway(): ?int
    {
        return $this->losesAway;
    }

    public function setLosesAway(int $losesAway): self
    {
        $this->losesAway = $losesAway;

        return $this;
    }

    public function getDrawsHome(): ?int
    {
        return $this->drawsHome;
    }

    public function setDrawsHome(int $drawsHome): self
    {
        $this->drawsHome = $drawsHome;

        return $this;
    }

    public function getDrawsAway(): ?int
    {
        return $this->drawsAway;
    }

    public function setDrawsAway(int $drawsAway): self
    {
        $this->drawsAway = $drawsAway;

        return $this;
    }

    public function getGoalsForHome(): ?int
    {
        return $this->goalsForHome;
    }

    public function setGoalsForHome(int $goalsForHome): self
    {
        $this->goalsForHome = $goalsForHome;

        return $this;
    }

    public function getGoalsForAway(): ?int
    {
        return $this->goalsForAway;
    }

    public function setGoalsForAway(int $goalsForAway): self
    {
        $this->goalsForAway = $goalsForAway;

        return $this;
    }

    public function getGoalsAgainstHome(): ?int
    {
        return $this->goalsAgainstHome;
    }

    public function setGoalsAgainstHome(int $goalsAgainstHome): self
    {
        $this->goalsAgainstHome = $goalsAgainstHome;

        return $this;
    }

    public function getGoalsAgainstAway(): ?int
    {
        return $this->goalsAgainstAway;
    }

    public function setGoalsAgainstAway(int $goalsAgainstAway): self
    {
        $this->goalsAgainstAway = $goalsAgainstAway;

        return $this;
    }

    public function getRedCard(): ?int
    {
        return $this->redCard;
    }

    public function setRedCard(int $redCard): self
    {
        $this->redCard = $redCard;

        return $this;
    }

    public function getYellowCard(): ?int
    {
        return $this->yellowCard;
    }

    public function setYellowCard(int $yellowCard): self
    {
        $this->yellowCard = $yellowCard;

        return $this;
    }
}
