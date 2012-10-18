<?php

namespace DC\TenisBundle\Tests\Unitary;

use DC\TenisBundle\Entity\Match;
use DC\TenisBundle\Entity\Game;

class MatchTest extends \PHPUnit_Framework_TestCase {

	public function testIShouldAddGamesToMatches() {
		// Arrange
		$match = new Match();
		$game = new Game();

		// Act
		$match->addGame($game);

		// Assert
		$this->assertEquals($game->getMatchId(), $match->getId());
	}

}