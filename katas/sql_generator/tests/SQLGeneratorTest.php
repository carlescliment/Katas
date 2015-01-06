<?php


require_once __DIR__ . '/../src/SQLGenerator.php';

class SQLGeneratorTest extends \PHPUnit_Framework_TestCase {

  // SUT
  private $generator;

  private $metadata;

  public function setUp() {
    $this->metadata = $this->getMock('Metadata', array('getTableName', 'getTableFields'));
    $this->generator = new SQLGenerator($this->metadata);
  }


  public function testItSelectsAllFields() {
    // Arrange
    $this->stubTableName('my_table');

    // Act
    $result = $this->generator->select();

    // Assert
    $this->assertEquals('SELECT * FROM my_table', $result);
  }


  public function testItSelectsOneExistingField() {
    // Arrange
    $this->stubTableName('my_table');
    $this->stubTableFields(array('foo'));

    // Act
    $result = $this->generator->select(array('foo'));

    // Assert
    $this->assertEquals('SELECT foo FROM my_table', $result);
  }


  public function testItSelectsTwoFields() {
    // Arrange
    $this->stubTableName('my_table');
    $this->stubTableFields(array('foo', 'bar'));

    // Act
    $result = $this->generator->select(array('foo', 'bar'));

    // Assert
    $this->assertEquals('SELECT foo, bar FROM my_table', $result);
  }

  public function testItSelectsMultipleFields() {
    // Arrange
    $this->stubTableName('my_table');
    $this->stubTableFields(array('foo', 'bar', 'baz', 'jar', 'jir', 'jor'));

    // Act
    $result = $this->generator->select(array('foo', 'bar', 'baz', 'jar', 'jir', 'jor'));

    // Assert
    $this->assertEquals('SELECT foo, bar, baz, jar, jir, jor FROM my_table', $result);
  }

  /**
   * @expectedException UnexistingFieldException
   */
  public function testItThrowsAnExceptionOnUnexistingFields() {
    // Arrange
    $this->stubTableName('my_table');
    $this->stubTableFields(array('foo', 'bar', 'baz'));

    // Act
    $result = $this->generator->select(array('xyz'));

    // Assert (exception expected)
  }


  public function testItDeletesAllRows() {
    // Arrange
    $this->stubTableName('my_table');

    // Act
    $result = $this->generator->delete();

    // Assert
    $this->assertEquals('DELETE FROM my_table', $result);
  }


  public function testItUpdatesAllRows() {
    // Arrange
    // Act
    $result = $this->generator->update(array('foo' => 'new value'));

    // Assert
    $this->assertEquals('UPDATE my_table SET foo="new value"', $result);
  }


  private function stubTableName($table_name) {
    $this->metadata->expects($this->any())
      ->method('getTableName')
      ->will($this->returnValue($table_name));
  }


  private function stubTableFields($table_fields) {
    $this->metadata->expects($this->any())
      ->method('getTableFields')
      ->will($this->returnValue($table_fields));
  }
}

