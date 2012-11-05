<?php

require_once dirname(__FILE__) . "/../src/GameScoreBoard.php";
require_once dirname(__FILE__) . "/score_in_a_row.php";

class TenisTest extends \PHPUnit_Framework_TestCase {

	private $scoreBoard;

	public function setUp() {
		$this->scoreBoard = new GameScoreBoard;
	}

	public function testThereIsNoWinnerWhenGameStarts() {
		$this->assertNull($this->scoreBoard->getWinner());
	}

	public function testThereIsNoWinnerWhenLeftPlayerScoresOnce() {
		$this->scoreBoard->scoreLeft();
		$this->assertNull($this->scoreBoard->getWinner());
	}

	public function testThereIsNoWinnerWhenRightPlayerScoresOnce() {
		$this->scoreBoard->scoreRight();
		$this->assertNull($this->scoreBoard->getWinner());
	}

	public function testLeftPlayerWinsWhenScoresFourTimesInARow() {
		left_player_scores_times($this->scoreBoard, 4);
		$this->assertEquals(GameScoreBoard::LEFT_PLAYER, $this->scoreBoard->getWinner());
		$this->assertNotNull($this->scoreBoard->getWinner());
	}

	public function testRightPlayerWinsWhenScoresFourTimesInARow() {
		right_player_scores_times($this->scoreBoard, 4);
		$this->assertEquals(GameScoreBoard::RIGHT_PLAYER, $this->scoreBoard->getWinner());
		$this->assertNotNull($this->scoreBoard->getWinner());
	}

	public function testThereIsNoWinnerOnEqualScores() {
		$this->setDeuce();
		$this->assertNull($this->scoreBoard->getWinner());
	}

	public function testThereIsNoWinnerOnAdvance() {
		$this->setDeuce();
		$this->scoreBoard->scoreLeft();
		$this->assertNull($this->scoreBoard->getWinner());
	}

	public function testThereIsAWinnerWhenADeuceIsResolved() {
		$this->setDeuce();
		right_player_scores_times($this->scoreBoard, 2);
		$this->assertNotNull($this->scoreBoard->getWinner());
	}

	/**
	 * @expectedException GameFinishedException
	 */
	public function testItDoesNotAllowScoringWhenGameIsFinished() {
		left_player_scores_times($this->scoreBoard, 4);
		$this->scoreBoard->scoreRight();
	}

	private function setDeuce() {
		right_player_scores_times($this->scoreBoard, 3);
		left_player_scores_times($this->scoreBoard, 3);
		$this->scoreBoard->scoreRight();
		$this->scoreBoard->scoreLeft();
	}

	private function leftPlayerScoresTimes($times) {
		for ($i = 0; $i < $times; $i++) {
			$this->scoreBoard->scoreLeft();
		}
	}

	private function rightPlayerScoresTimes($times) {
		for ($i = 0; $i < $times; $i++) {
			$this->scoreBoard->scoreRight();
		}
	}

}