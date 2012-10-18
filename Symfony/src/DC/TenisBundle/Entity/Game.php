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
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $score1
     *
     * @ORM\Column(name="score1", type="integer")
     */
    private $score1 = 0;

    /**
     * @var integer $score2
     *
     * @ORM\Column(name="score2", type="integer")
     */
    private $score2 = 0;


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
     * Set score1
     *
     * @param integer $score1
     * @return Game
     */
    public function setScore1($score1)
    {
        $this->score1 = $score1;
    
        return $this;
    }

    /**
     * Get score1
     *
     * @return integer 
     */
    public function getScore1()
    {
        return $this->score1;
    }

    /**
     * Set score2
     *
     * @param integer $score2
     * @return Game
     */
    public function setScore2($score2)
    {
        $this->score2 = $score2;
    
        return $this;
    }

    /**
     * Get score2
     *
     * @return integer 
     */
    public function getScore2()
    {
        return $this->score2;
    }
}
