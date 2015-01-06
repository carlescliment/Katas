<?php



require_once __DIR__ . '/SQLQuery.php';

class SelectSQLQuery extends SQLQuery {


	public function __construct($fields, Metadata $metadata) {
		parent::__construct($metadata);
		$fields_clause = $fields ? implode(', ', $fields) : '*';
		$table_name = $metadata->getTableName();
		$this->query = "SELECT $fields_clause FROM $table_name";
	}


	public function __toString() {
		return $this->query;
	}


}