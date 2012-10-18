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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set running
     *
     * @param boolean $running
     * @return Game
     */
    public function setRunning($running)
    {
        $this->running = $running;
        return $this;
    }

    /**
     * Get running
     *
     * @return boolean
     */
    public function getRunning()
    {
        return $this->running;
    }
}
