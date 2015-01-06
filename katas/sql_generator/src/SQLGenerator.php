<?php

require_once __DIR__ .'/FieldsValidator.php';

class SQLGenerator {

	private $metadata;

	public function __construct(Metadata $metadata) {
		$this->metadata = $metadata;
	}

	public function select(array $fields = array()) {
		FieldsValidator::validate($this->metadata, $fields);
		return new SelectSQLQuery($fields, $this->metadata);
	}

	public function delete() {
		return new DeleteSQLQuery($this->metadata);
	}

	public function update() {
		return 'UPDATE my_table SET foo="new value"';
	}


}

