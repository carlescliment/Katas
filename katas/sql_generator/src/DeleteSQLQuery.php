<?php

require_once __DIR__ . '/SQLQuery.php';

class DeleteSQLQuery extends SQLQuery {

	public function __toString() {
		return $this->query;
	}

	public function __construct(Metadata $metadata) {
		parent::__construct($metadata);
		$table_name = $metadata->getTableName();
		$this->query = "DELETE FROM $table_name";
	}

}