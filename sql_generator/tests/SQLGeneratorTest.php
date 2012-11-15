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

  public function testItShouldOrderByFields() {
    // Arrange
    $this->stubTableName('my_table');
    $this->stubTableFields(array('foo', 'bar', 'baz'));

    // Act
    $result = $this->generator->select(array('foo', 'bar'))
                              ->orderBy(array('bar'));

    // Assert
    $this->assertEquals('SELECT foo, bar FROM my_table ORDER BY bar', $result);
  }

  /**
   * @expectedException UnexistingFieldException
   */
  public function testItThrowsAnExceptionWhenOrderingByUnexistingFields() {
    // Arrange
    $this->stubTableName('my_table');
    $this->stubTableFields(array('foo', 'bar', 'baz'));

    // Act
    $result = $this->generator->select(array('foo', 'bar'))
                              ->orderBy(array('xyz'));

    // Assert (implicit)
  }

  public function testItOrdersByAsc() {
    // Arrange
    $this->stubTableName('my_table');
    $this->stubTableFields(array('foo', 'bar', 'baz'));

    // Act
    $result = $this->generator->select(array('foo', 'bar'))
                              ->orderBy(array('bar'), array('desc'));

    // Assert
    $this->assertEquals('SELECT foo, bar FROM my_table ORDER BY bar DESC', $result);
  }


  public function testItOrdersManyFields() {
    // Arrange
    $this->stubTableName('my_table');
    $this->stubTableFields(array('foo', 'bar', 'baz'));

    // Act
    $result = $this->generator->select(array('foo', 'bar'))
                              ->orderBy(array('bar', 'foo'), array('desc', 'asc'));

    // Assert
    $this->assertEquals('SELECT foo, bar FROM my_table ORDER BY bar DESC, foo ASC', $result);
  }

  public function testItLimitsResults() {
    // Arrange
    $this->stubTableName('my_table');
    $this->stubTableFields(array('foo', 'bar', 'baz'));

    // Act
    $result = $this->generator->select()
                              ->limit(1);

    // Assert
    $this->assertEquals('SELECT * FROM my_table LIMIT 1', $result);
  }


  public function testItLimitsResultsByAnyAmount() {
    // Arrange
    $this->stubTableName('my_table');
    $this->stubTableFields(array('foo', 'bar', 'baz'));

    // Act
    $result = $this->generator->select()
                              ->limit(1234);

    // Assert
    $this->assertEquals('SELECT * FROM my_table LIMIT 1234', $result);
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


