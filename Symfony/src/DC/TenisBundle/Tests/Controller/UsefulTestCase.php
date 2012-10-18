<?php

namespace DC\TenisBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsefulTestCase extends WebTestCase {

	protected $client;
	protected $em;

	public function __construct() {
		parent::__construct();
		$this->client = static::createClient();
		$this->client->followRedirects();
		$this->em = self::$kernel->getContainer()->get('doctrine.orm.entity_manager');
	}

	protected function truncateTables(array $tables) {
		$connection = $this->em->getConnection();
        $platform = $connection->getDatabasePlatform();
        $connection->query("SET foreign_key_checks = 0");
        foreach ($tables as $table) {
            $connection->executeUpdate($platform->getTruncateTableSQL($table));
        }
        $connection->query("SET foreign_key_checks = 1");
	}

    protected function printContents() {
        print $this->client->getResponse()->getContent();
    }
}