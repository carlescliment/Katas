<?php


require_once __DIR__ . '/../src/SQLGenerator.php';

class SQLCollaboratorTest extends \PHPUnit_Framework_TestCase {

	// SUT
	private $generator;

	private $metadata;

	public function setUp() {
		$this->metadata = $this->getMock('Metadata', array('getTableName', 'getTableFields'));
		$this->generator = new SQLGenerator($this->metadata);
	}


	public function testItRetrievesTableNameFromMetadata() {
		// Arrange
		$this->metadata->expects($this->once())
			->method('getTableName');

		// Act
		$this->generator->select();

		// Assert (implicit)
	}

	public function testRetrievesTableFieldsFromMetadata() {
		// Arrange
		$this->metadata->expects($this->once())
			->method('getTableFields');

		// Act
		$this->generator->select();

		// Assert (implicit)
	}
}
