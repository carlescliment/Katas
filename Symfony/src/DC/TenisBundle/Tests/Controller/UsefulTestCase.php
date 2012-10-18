<?php

namespace DC\TenisBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsefulTestCase extends WebTestCase {

	protected $client;

	public function __construct() {
		parent::__construct();
		$this->client = static::createClient();
	}
}