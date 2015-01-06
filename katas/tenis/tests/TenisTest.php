<?php

require_once dirname(__FILE__) . "/../src/GameScoreBoard.php";
require_once dirname(__FILE__) . "/score_in_a_row.php";

class TenisTest extends \PHPUnit_Framework_TestCase {

	private $scoreBoard;

	public function setUp() {
		$this->scoreBoard = new GameScoreBoard;
	}

	public function testThereIsNoWinnerWhenGameStarts() {
		// Arrange
		// Act
		$winner = $this->scoreBoard->getWinner();

		// Assert
		$this->assertNull($winner);
	}

	public function testThereIsNoWinnerWhenLeftPlayerScoresOnce() {
		// Arrange
		$this->scoreBoard->scoreLeft();

		// Act
		$winner = $this->scoreBoard->getWinner();

		// Assert
		$this->assertNull($winner);
	}

	public function testThereIsNoWinnerWhenRightPlayerScoresOnce() {
		// Arrange
		$this->scoreBoard->scoreRight();

		// Act
		$winner = $this->scoreBoard->getWinner();

		// Assert
		$this->assertNull($winner);
	}

	public function testLeftPlayerWinsWhenScoresFourTimesInARow() {
		// Arrange
		left_player_scores_times($this->scoreBoard, 4);

		// Act
		$winner = $this->scoreBoard->getWinner();

		// Assert
		$this->assertEquals(GameScoreBoard::LEFT_PLAYER, $winner);
	}

	public function testRightPlayerWinsWhenScoresFourTimesInARow() {
		// Arrange
		right_player_scores_times($this->scoreBoard, 4);

		// Act
		$winner = $this->scoreBoard->getWinner();

		// Assert
		$this->assertEquals(GameScoreBoard::RIGHT_PLAYER, $winner);
	}

	public function testThereIsNoWinnerOnEqualScores() {
		// Arrange
		set_deuce($this->scoreBoard);

		// Act
		$winner = $this->scoreBoard->getWinner();

		// Assert
		$this->assertNull($winner);
	}

	public function testThereIsNoWinnerOnAdvance() {
		// Arrange
		set_deuce($this->scoreBoard);
		$this->scoreBoard->scoreLeft();

		// Act
		$winner = $this->scoreBoard->getWinner();

		// Assert
		$this->assertNull($winner);
	}

	public function testThereIsAWinnerWhenADeuceIsResolved() {
		// Arrange
		set_deuce($this->scoreBoard);
		right_player_scores_times($this->scoreBoard, 2);

		// Act
		$winner = $this->scoreBoard->getWinner();

		// Assert
		$this->assertNotNull($winner);
	}

	/**
	 * @expectedException GameFinishedException
	 */
	public function testItDoesNotAllowScoringWhenGameIsFinished() {
		// Arrange
		left_player_scores_times($this->scoreBoard, 4);

		// Act
		$this->scoreBoard->scoreRight();

		// Expect (implicit)
	}


	public function testGamePassesScoresToRenderProperly() {
		// Arrange
		$render = $this->getMock('TenisRender');
		$render->expects($this->once())
			->method('render')
			->with(1, 0);
		$this->scoreBoard->scoreLeft();

		// Act
		$this->scoreBoard->render($render);

		// Assert (implicit)
	}

}