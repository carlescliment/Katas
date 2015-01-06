<?php


require_once __DIR__ .'/FieldsValidator.php';

abstract class SQLQuery {

	protected $query;
	private $metadata;

	public function __construct(Metadata $metadata) {
		$this->metadata = $metadata;
	}

	public function limit($rows) {
		$this->query .= " LIMIT $rows";
		return $this;
	}

	public function orderBy(array $fields, array $orders = array()) {
		$this->buildOrderedMultifieldClause('ORDER BY', $fields, $orders);
		return $this;
	}


	public function groupBy(array $fields, array $orders = array()) {
		$this->buildOrderedMultifieldClause('GROUP BY', $fields, $orders);
		return $this;
	}



	private function buildOrderedMultifieldClause($clause_prefix, array $fields, array $orders) {
		FieldsValidator::validate($this->metadata, $fields);
		$ordered_fields = $this->buildOrderedFieldsFromInputParameters($fields, $orders);
		$this->buildFieldsClause($clause_prefix, $ordered_fields);
	}


	private function buildFieldsClause($clause, $fields) {
		$this->query .= " $clause " . implode(', ', $fields);
	}


	private function buildOrderedFieldsFromInputParameters(array $fields, array $orders) {
		$ordered_fields = array();
		for ($i=0; $i<count($fields); $i++) {
			$ordered_fields[] = $fields[$i] . (isset($orders[$i]) ? ' ' . strtoupper($orders[$i]) : '');
		}
		return $ordered_fields;
	}

}