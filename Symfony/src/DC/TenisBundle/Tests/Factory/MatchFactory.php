<?php

namespace DC\TenisBundle\Tests\Factory;

use DC\TenisBundle\Entity\Match;

class MatchFactory {

	public static function create($em) {
    	$match = new Match();
    	$em->persist($match);
    	$em->flush();
    	return $match;
	}
}