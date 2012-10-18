<?php

namespace DC\TenisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * DC\TenisBundle\Entity\Match
 *
 * @ORM\Table(name="matches")
 * @ORM\Entity(repositoryClass="DC\TenisBundle\Entity\MatchRepository")
 */
class Match
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean $running
     *
     * @ORM\Column(name="running", type="boolean")
     */
    private $running = false;

    /**
    * @ORM\OneToMany(targetEntity="Game", mappedBy="match")
    */
    private $games;


    public function __construct() {
        $this->games = new \Doctrine\Common\Collections\ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }


    public function addGame(Game $game) {
        $game->setMatch($this);
        $this->games[] = $game;
    }
}
