<?php


class UnexistingFieldException extends Exception {}

class SQLGenerator {

	private $metadata;

	private $query = '';

	public function __construct(Metadata $metadata) {
		$this->metadata = $metadata;
	}

	public function __toString() {
		return $this->query;
	}


	public function select(array $fields = array()) {
		$this->verifyThatAllFieldsExistInTable($fields);
		$fields_clause = $fields ? implode(', ', $fields) : '*';
		$table_name = $this->metadata->getTableName();
		$this->query = "SELECT $fields_clause FROM $table_name";
		return $this;
	}

	public function orderBy(array $fields, array $orders = array()) {
		$this->verifyThatAllFieldsExistInTable($fields);
		$ordered_fields = $this->buildOrderedFieldsFromInputParameters($fields, $orders);
		$this->query .= ' ORDER BY ' . implode(', ', $ordered_fields);
		return $this;
	}

	public function limit($rows) {
		$this->query .= " LIMIT $rows";
		return $this;
	}


	private function verifyThatAllFieldsExistInTable(array $fields) {
		$table_fields = $this->metadata->getTableFields();
		foreach ($fields as $field) {
			if (!in_array($field, $table_fields)) {
				throw new UnexistingFieldException;
			}
		}
	}

	private function buildOrderedFieldsFromInputParameters(array $fields, array $orders) {
		$ordered_fields = array();
		for ($i=0; $i<count($fields); $i++) {
			$ordered_fields[] = $fields[$i] . (isset($orders[$i]) ? ' ' . strtoupper($orders[$i]) : '');
		}
		return $ordered_fields;
	}
}