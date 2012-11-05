<?php

function left_player_scores_times($game, $times) {
	for ($i = 0; $i < $times; $i++) {
		$game->scoreLeft();
	}
}


function right_player_scores_times($game, $times) {
	for ($i = 0; $i < $times; $i++) {
		$game->scoreRight();
	}
}

function set_deuce($game) {
	right_player_scores_times($game, 3);
	left_player_scores_times($game, 3);
	$game->scoreRight();
	$game->scoreLeft();
}