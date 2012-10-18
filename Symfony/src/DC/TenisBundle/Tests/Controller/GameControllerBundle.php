<?php

namespace DC\TenisBundle\Tests\Controller;

use DC\TenisBundle\Entity\Match;

class GameControllerTest extends UsefulTestCase
{
    public function testIShouldStartAMatch()
    {
    	// Arrange
    	// Act
    	$this->startANewMatchThroughInterface();

    	// Assert
    	$this->assertTrue($this->client->getResponse()->isSuccessful());
    }


    public function testItCreatesANewGameWhenStartingAGame() {
    	// Arrange
    	$this->truncateTables(array('matches'));

    	// Act
    	$this->startANewMatchThroughInterface();

    	//Assert
    	$games = $this->em->getRepository('DCTenisBundle:Match')->findAll();
    	$this->assertEquals(1, count($games));
    }


    public function testIShouldAccessToAGame() {
    	// Arrange
    	$match = new Match();
    	$this->em->persist($match);
    	$this->em->flush();

    	// Act
    	$this->client->request('GET', '/tenis/' . $match->getId());

		// Assert
    	$this->assertTrue($this->client->getResponse()->isSuccessful());
    }


	private function startANewMatchThroughInterface() {
    	$crawler = $this->client->request('GET', '/tenis');
		$link = $crawler->filter('a#start-match')->link();
    	$this->client->click($link);
	}

}
