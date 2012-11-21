<?php

require_once __DIR__ . '/../src/DeleteSQLQuery.php';

class DeleteSQLQueryTest extends PHPUnit_Framework_TestCase {

  public function testItDeletesLimited() {
    // Arrange
    $metadata = $this->getMock('Metadata', array('getTableFields'));
    $query = new DeleteSQLQuery($metadata);

    // Act
    $result = $query->limit(1);

    // Assert
    $this->assertEquals('DELETE FROM my_table LIMIT 1', $result);
  }

  public function testItDeletesOrderedByFields() {
    // Arrange
    $table_fields = array('foo');
    $metadata = $this->getMock('Metadata', array('getTableFields'));
    $metadata->expects($this->any())
      ->method('getTableFields')
      ->will($this->returnValue($table_fields));
    $query = new DeleteSQLQuery($metadata);


    // Act
    $result = $query->orderBy(array('foo'), array('desc'));

    // Assert
    $this->assertEquals('DELETE FROM my_table ORDER BY foo DESC', $result);
  }
}