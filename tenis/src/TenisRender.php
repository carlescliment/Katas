<?php

interface TenisRender {

	public function render($left_score, $right_score);
	public function leftWins();
	public function rightWins();
}
