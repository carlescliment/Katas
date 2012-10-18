<?php

namespace DC\TenisBundle\Tests\Controller;


class GameControllerTest extends UsefulTestCase
{
    public function testIShouldStartAGame()
    {
    	// Arrange
    	$crawler = $this->client->request('GET', '/tenis');
		$link = $crawler->filter('a#start-game')->link();

    	// Act
    	$this->client->click($link);

    	// Assert
    	$this->assertTrue($this->client->getResponse()->isSuccessful());
    }


    public function testItCreatesANewGameWhenStartingAGame() {
    	// Arrange
    	$this->truncateTables(array('Game'));
    	$crawler = $this->client->request('GET', '/tenis');
    	$link = $crawler->filter('a#start-game')->link();

    	// Act
    	$this->client->click($link);

    	//Assert
    	$games = $this->em->getRepository('DCTenisBundle:Game')->findAll();
    	$this->assertEquals(1, count($games));
    }
}
