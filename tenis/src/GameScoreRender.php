<?php

require_once(dirname(__FILE__) . '/TenisRender.php');

class GameScoreRender implements TenisRender {

	public function render($left_score, $right_score) {
		if (min($left_score, $right_score) >= 4) {
			return $this->resolveHighScores($left_score, $right_score);
		}
		$left_repr = $this->scoreToRepr($left_score);
		$right_repr = $this->scoreToRepr($right_score);
		return "$left_repr-$right_repr";
	}


	public function leftWins() {
		return "LEFT WINS";
	}

	public function rightWins() {
		return "RIGHT WINS";
	}

	private function scoreToRepr($score) {
		switch($score) {
			case 0:
				return '0';
			case 1:
				return '15';
			case 2:
				return '30';
			case 3:
				return '40';
			case 4:
				return 'ADV';
		}
		throw new Exception("Unrecognized score $score");
	}


	private function resolveHighScores($left_score, $right_score) {
		if ($left_score == $right_score) {
			return 'DEUCE';
		}
		return $left_score > $right_score ? 'ADV-40' : '40-ADV';
	}
}