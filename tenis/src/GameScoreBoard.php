<?php

require_once(dirname(__FILE__) . '/GameScoreRender.php');

class GameFinishedException extends Exception {}

class GameScoreBoard {

	const LEFT_PLAYER = 'left';
	const RIGHT_PLAYER = 'right';

	private $left = 0;
	private $right = 0;
	private $MIN_POINTS_TO_WIN = 4;


	public function getWinner() {
		if ($this->anyPlayerScoredEnoughToWin() && $this->isEnoughDifferenceBetweenPlayerScores()) {
			return $this->getBestPlayer();
		}

		return null;
	}


	public function scoreLeft() {
		$this->throwExceptionIfFinished();
		$this->left++;
	}


	public function scoreRight() {
		$this->throwExceptionIfFinished();
		$this->right++;
	}


	public function render(TenisRender $render) {
		if ($winner = $this->getWinner()) {
			return $winner == self::LEFT_PLAYER ? 'LEFT WINS' : 'RIGHT WINS';

		}
		return  $render->render($this->left, $this->right);
	}




	private function anyPlayerScoredEnoughToWin() {
		return $this->getBestScore() >= $this->MIN_POINTS_TO_WIN;
	}


	private function getBestScore() {
		return max($this->left, $this->right);
	}


	private function getBestPlayer() {
		if ($this->left == $this->right) {
			return NULL;
		}
		if ($this->left > $this->right) {
			return self::LEFT_PLAYER;
		}
		return self::RIGHT_PLAYER;
	}


	private function isEnoughDifferenceBetweenPlayerScores() {
		$difference = abs($this->left - $this->right);
		return $difference >= 2;
	}


	private function throwExceptionIfFinished() {
		if ($this->getWinner()) {
			throw new GameFinishedException('Players cannot score when game is finished.');
		}
	}
}