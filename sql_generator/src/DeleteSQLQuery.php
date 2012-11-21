<?php

require_once __DIR__ . '/SQLQuery.php';

class DeleteSQLQuery extends SQLQuery {

	public function __toString() {
		return $this->query;
	}

	public function __construct(Metadata $metadata) {
		parent::__construct($metadata);
		$this->query = 'DELETE FROM my_table';
	}

}