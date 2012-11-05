<?php

require_once dirname(__FILE__) . "/../src/GameScoreBoard.php";
require_once dirname(__FILE__) . "/../src/GameScoreRender.php";
require_once dirname(__FILE__) . "/score_in_a_row.php";


class GameScoreRenderTest extends \PHPUnit_Framework_TestCase {

	private $game;
	private $render;

	public function setUp() {
		$this->game = new GameScoreBoard;
		$this->render = new GameScoreRender;
	}

	public function test_15_0() {
		// Arrange
		$this->game->scoreLeft();

		// Act
		$results = $this->game->render($this->render);

		// Assert
		$this->assertEquals('15-0', $results);

	}

	public function test_15_15() {
		// Arrange
		$this->game->scoreLeft();
		$this->game->scoreRight();

		// Act
		$results = $this->game->render($this->render);

		// Assert
		$this->assertEquals('15-15', $results);
	}

	public function test_30_15() {
		// Arrange
		left_player_scores_times($this->game, 2);
		$this->game->scoreRight();

		// Act
		$results = $this->game->render($this->render);

		// Assert
		$this->assertEquals('30-15', $results);
	}

	public function test_40_15() {
		// Arrange
		left_player_scores_times($this->game, 3);
		$this->game->scoreRight();

		// Act
		$results = $this->game->render($this->render);

		// Assert
		$this->assertEquals('40-15', $results);
	}

	public function test_40_40() {
		// Arrange
		left_player_scores_times($this->game, 3);
		right_player_scores_times($this->game, 3);

		// Act
		$results = $this->game->render($this->render);

		// Assert
		$this->assertEquals('40-40', $results);
	}

	public function test_ADV_40() {
		// Arrange
		left_player_scores_times($this->game, 3);
		right_player_scores_times($this->game, 3);
		$this->game->scoreLeft();

		// Act
		$results = $this->game->render($this->render);

		// Assert
		$this->assertEquals('ADV-40', $results);
	}

	public function test_40_ADV() {
		// Arrange
		left_player_scores_times($this->game, 3);
		right_player_scores_times($this->game, 3);
		$this->game->scoreRight();

		// Act
		$results = $this->game->render($this->render);

		// Assert
		$this->assertEquals('40-ADV', $results);
	}

	public function test_DEUCE() {
		// Arrange
		left_player_scores_times($this->game, 3);
		right_player_scores_times($this->game, 3);
		$this->game->scoreRight();
		$this->game->scoreLeft();

		// Act
		$results = $this->game->render($this->render);

		// Assert
		$this->assertEquals('DEUCE', $results);
	}


	public function test_DEUCE_broken() {
		// Arrange
		left_player_scores_times($this->game, 3);
		right_player_scores_times($this->game, 3);
		$this->game->scoreRight();
		$this->game->scoreLeft();
		$this->game->scoreLeft();

		// Act
		$results = $this->game->render($this->render);

		// Assert
		$this->assertEquals('ADV-40', $results);
	}

	public function test_left_wins() {
		// Arrange
		left_player_scores_times($this->game, 4);

		// Act
		$results = $this->game->render($this->render);

		// Assert
		$this->assertEquals('LEFT WINS', $results);
	}


	public function test_right_wins() {
		// Arrange
		right_player_scores_times($this->game, 4);

		// Act
		$results = $this->game->render($this->render);

		// Assert
		$this->assertEquals('RIGHT WINS', $results);
	}
}
