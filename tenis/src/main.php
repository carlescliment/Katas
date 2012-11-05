<?php

require_once(dirname(__FILE__) . '/GameScoreBoard.php');
require_once(dirname(__FILE__) . '/GameScoreRender.php');

$game = new GameScoreBoard;
$render = new GameScoreRender;


do {
	if (rand(0, 1) == 0) {
		print "Left player scores\n";
		$game->scoreLeft();
	}
	else {
		print "Right player scores\n";
		$game->scoreRight();
	}
	print $game->render($render) . "\n";

} while (!$game->getWinner());