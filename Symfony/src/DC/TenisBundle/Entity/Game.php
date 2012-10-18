<?php

namespace DC\TenisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DC\TenisBundle\Entity\Game
 *
 * @ORM\Table(name="games")
 * @ORM\Entity(repositoryClass="DC\TenisBundle\Entity\GameRepository")
 */
class Game
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="score1", type="integer")
     */
    private $score1 = 0;

    /**
     * @ORM\Column(name="score2", type="integer")
     */
    private $score2 = 0;


    /**
     * @ORM\ManyToOne(targetEntity="Match", inversedBy="games")
     * @ORM\JoinColumn(name="match_id", referencedColumnName="id")
     */
    private $match;



    public function getId()
    {
        return $this->id;
    }


    public function setMatch(Match $match) {
        $this->match = $match;
    }

    public function getMatchId() {
        if ($this->match) {
            return $this->match->getId();
        }
        return null;
    }
}
