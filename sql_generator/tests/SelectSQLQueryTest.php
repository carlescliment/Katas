<?php

require_once __DIR__ . '/../src/SelectSQLQuery.php';

class SelectSQLQueryTest extends PHPUnit_Framework_TestCase {

  private $metadata;
  private $query;

  public function setUp() {
  	$this->metadata = $this->getMock('Metadata', array('getTableName', 'getTableFields'));
    $this->metadata->expects($this->any())
    		 ->method('getTableName')
    		 ->will($this->returnValue('my_table'));
  	$this->query = new SelectSQLQuery(array(), $this->metadata);
  }

  public function testItLimitsResults() {
    // Arrange
    // Act
    $result = $this->query->limit(1);

    // Assert
    $this->assertEquals('SELECT * FROM my_table LIMIT 1', $result);
  }



  public function testItLimitsResultsByAnyAmount() {
    // Arrange
    // Act
    $result = $this->query->limit(1234);

    // Assert
    $this->assertEquals('SELECT * FROM my_table LIMIT 1234', $result);
  }


  public function testItGroupsByOneField() {
  	// Arrange
	$this->stubTableFields(array('foo'));
  	// Act
  	$result = $this->query->groupBy(array('foo'));

  	// Assert
  	$this->assertEquals('SELECT * FROM my_table GROUP BY foo', $result);
  }

  public function testItGroupsByManyFields() {
	// Arrange
	$this->stubTableFields(array('foo', 'bar', 'baz'));

  	// Act
  	$result = $this->query->groupBy(array('foo', 'bar', 'baz'));

  	// Assert
  	$this->assertEquals('SELECT * FROM my_table GROUP BY foo, bar, baz', $result);
  }


  /**
   * @expectedException UnexistingFieldException
   */
  public function testItThrowsAnExceptionWhenGroupingByUnexistingFields() {
	// Arrange
	$this->stubTableFields(array('foo', 'bar'));

  	// Act
  	$result = $this->query->groupBy(array('baz'));

  	// Assert (exception)
  }


  public function testItGroupsByDesc() {
	// Arrange
	$this->stubTableFields(array('foo'));

  	// Act
  	$result = $this->query->groupBy(array('foo'), array('desc'));

  	// Assert
  	$this->assertEquals('SELECT * FROM my_table GROUP BY foo DESC', $result);
  }


  public function testItGroupsByManyOrderedFields() {
	// Arrange
	$this->stubTableFields(array('foo', 'bar', 'baz'));

  	// Act
  	$result = $this->query->groupBy(array('foo', 'baz'), array('desc', 'asc'));

  	// Assert
  	$this->assertEquals('SELECT * FROM my_table GROUP BY foo DESC, baz ASC', $result);
  }


  private function stubTableFields($table_fields) {
    $this->metadata->expects($this->any())
      ->method('getTableFields')
      ->will($this->returnValue($table_fields));
  }

}

