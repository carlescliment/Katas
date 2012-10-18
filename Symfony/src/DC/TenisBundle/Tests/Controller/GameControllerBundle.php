<?php

namespace DC\TenisBundle\Tests\Controller;


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


	private function startANewGameThroughInterface() {
    	$crawler = $this->client->request('GET', '/tenis');
		$link = $crawler->filter('a#start-game')->link();
    	$this->client->click($link);
	}


}
