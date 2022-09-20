<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\LeagueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LeagueRepository::class)]
#[ApiResource]
class League
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $apiId = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $season = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $start = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $end = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $logo = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $flag = null;

    #[ORM\OneToMany(mappedBy: 'league', targetEntity: PlayerStat::class)]
    private Collection $playerStats;

    #[ORM\OneToOne(mappedBy: 'league', cascade: ['persist', 'remove'])]
    private ?Standing $standing = null;

    #[ORM\OneToMany(mappedBy: 'league', targetEntity: Game::class)]
    private Collection $games;

    #[ORM\OneToMany(mappedBy: 'league', targetEntity: Round::class)]
    private Collection $rounds;

    #[ORM\OneToMany(mappedBy: 'league', targetEntity: TeamStat::class)]
    private Collection $teamStats;

    public function __construct()
    {
        $this->playerStats = new ArrayCollection();
        $this->games = new ArrayCollection();
        $this->rounds = new ArrayCollection();
        $this->teamStats = new ArrayCollection();
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

    public function getSeason(): ?int
    {
        return $this->season;
    }

    public function setSeason(int $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getStart(): ?\DateTimeImmutable
    {
        return $this->start;
    }

    public function setStart(\DateTimeImmutable $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeImmutable
    {
        return $this->end;
    }

    public function setEnd(\DateTimeImmutable $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getFlag(): ?string
    {
        return $this->flag;
    }

    public function setFlag(string $flag): self
    {
        $this->flag = $flag;

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
            $playerStat->setLeague($this);
        }

        return $this;
    }

    public function removePlayerStat(PlayerStat $playerStat): self
    {
        if ($this->playerStats->removeElement($playerStat)) {
            // set the owning side to null (unless already changed)
            if ($playerStat->getLeague() === $this) {
                $playerStat->setLeague(null);
            }
        }

        return $this;
    }

    public function getStanding(): ?Standing
    {
        return $this->standing;
    }

    public function setStanding(Standing $standing): self
    {
        // set the owning side of the relation if necessary
        if ($standing->getLeague() !== $this) {
            $standing->setLeague($this);
        }

        $this->standing = $standing;

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->setLeague($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getLeague() === $this) {
                $game->setLeague(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Round>
     */
    public function getRounds(): Collection
    {
        return $this->rounds;
    }

    public function addRound(Round $round): self
    {
        if (!$this->rounds->contains($round)) {
            $this->rounds->add($round);
            $round->setLeague($this);
        }

        return $this;
    }

    public function removeRound(Round $round): self
    {
        if ($this->rounds->removeElement($round)) {
            // set the owning side to null (unless already changed)
            if ($round->getLeague() === $this) {
                $round->setLeague(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TeamStat>
     */
    public function getTeamStats(): Collection
    {
        return $this->teamStats;
    }

    public function addTeamStat(TeamStat $teamStat): self
    {
        if (!$this->teamStats->contains($teamStat)) {
            $this->teamStats->add($teamStat);
            $teamStat->setLeague($this);
        }

        return $this;
    }

    public function removeTeamStat(TeamStat $teamStat): self
    {
        if ($this->teamStats->removeElement($teamStat)) {
            // set the owning side to null (unless already changed)
            if ($teamStat->getLeague() === $this) {
                $teamStat->setLeague(null);
            }
        }

        return $this;
    }
}
