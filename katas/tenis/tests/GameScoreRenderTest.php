<?php

require_once dirname(__FILE__) . "/../src/GameScoreRender.php";


class GameScoreRenderTest extends \PHPUnit_Framework_TestCase {

	private $render;

	public function setUp() {
		$this->render = new GameScoreRender;
	}

	public function test_15_0() {
		// Arrange
		// Act
		$results = $this->render->render(1, 0);

		// Assert
		$this->assertEquals('15-0', $results);

	}

	public function test_15_15() {
		// Arrange
		// Act
		$results = $this->render->render(1, 1);

		// Assert
		$this->assertEquals('15-15', $results);
	}

	public function test_30_15() {
		// Arrange
		// Act
		$results = $this->render->render(2, 1);

		// Assert
		$this->assertEquals('30-15', $results);
	}

	public function test_40_15() {
		// Arrange
		// Act
		$results = $this->render->render(3, 1);

		// Assert
		$this->assertEquals('40-15', $results);
	}

	public function test_40_40() {
		// Arrange
		// Act
		$results = $this->render->render(3, 3);

		// Assert
		$this->assertEquals('40-40', $results);
	}

	public function test_ADV_40() {
		// Arrange
		// Act
		$results = $this->render->render(4, 3);

		// Assert
		$this->assertEquals('ADV-40', $results);
	}

	public function test_40_ADV() {
		// Arrange
		// Act
		$results = $this->render->render(3, 4);

		// Assert
		$this->assertEquals('40-ADV', $results);
	}

	public function test_DEUCE() {
		// Arrange
		// Act
		$results = $this->render->render(4, 4);

		// Assert
		$this->assertEquals('DEUCE', $results);
	}


	public function test_DEUCE_broken() {
		// Arrange
		// Act
		$results = $this->render->render(5, 4);

		// Assert
		$this->assertEquals('ADV-40', $results);
	}

	public function test_left_wins() {
		// Arrange
		// Act
		$results = $this->render->leftWins();

		// Assert
		$this->assertEquals('LEFT WINS', $results);
	}


	public function test_right_wins() {
		// Arrange
		// Act
		$results = $this->render->rightWins();

		// Assert
		$this->assertEquals('RIGHT WINS', $results);
	}
}
