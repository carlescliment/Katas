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