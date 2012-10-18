<?php

namespace DC\TenisBundle\Tests\Controller;

use DC\TenisBundle\Entity\Game;

class GameControllerTest extends UsefulTestCase
{
    public function testIShouldStartAGame()
    {
    	// Assert
    	// Act
    	$this->startANewGameThroughInterface();

    	// Assert
    	$this->assertTrue($this->client->getResponse()->isSuccessful());
    }


    public function testItCreatesANewGameWhenStartingAGame() {
    	// Arrange
    	$this->truncateTables(array('Game'));
    	// Act
    	$this->startANewGameThroughInterface();

    	//Assert
    	$games = $this->em->getRepository('DCTenisBundle:Game')->findAll();
    	$this->assertEquals(1, count($games));
    }


    public function testIShouldAccessToAGame() {
    	// Arrange
    	$game = new Game();
    	$this->em->persist($game);
    	$this->em->flush();

    	// Act
    	$this->client->request('GET', '/tenis/' . $game->getId());

		// Assert
    	$this->assertTrue($this->client->getResponse()->isSuccessful());
    }


	private function startANewGameThroughInterface() {
    	$crawler = $this->client->request('GET', '/tenis');
		$link = $crawler->filter('a#start-game')->link();
    	$this->client->click($link);
	}

}
