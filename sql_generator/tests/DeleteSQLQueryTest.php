<?php

require_once __DIR__ . '/../src/DeleteSQLQuery.php';

class DeleteSQLQueryTest extends PHPUnit_Framework_TestCase {

  private $metadata;

  public function setUp() {
    $this->metadata = $this->getMock('Metadata', array('getTableFields', 'getTableName'));

  }

  public function testItDeletesLimited() {
    // Arrange
    $this->stubTableName('my_table');
    $query = new DeleteSQLQuery($this->metadata);

    // Act
    $result = $query->limit(1);

    // Assert
    $this->assertEquals('DELETE FROM my_table LIMIT 1', $result);
  }

  public function testItDeletesOrderedByFields() {
    // Arrange
    $this->stubTableName('my_table');
    $table_fields = array('foo');
    $this->metadata->expects($this->any())
      ->method('getTableFields')
      ->will($this->returnValue($table_fields));
    $query = new DeleteSQLQuery($this->metadata);


    // Act
    $result = $query->orderBy(array('foo'), array('desc'));

    // Assert
    $this->assertEquals('DELETE FROM my_table ORDER BY foo DESC', $result);
  }


  private function stubTableName($table_name) {
    $this->metadata->expects($this->any())
      ->method('getTableName')
      ->will($this->returnValue($table_name));
  }
}