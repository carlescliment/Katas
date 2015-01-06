<?php

class UnexistingFieldException extends Exception {}

class FieldsValidator {

	public static function validate(Metadata $metadata, array $fields) {
		$table_fields = $metadata->getTableFields();
		foreach ($fields as $field) {
			if (!in_array($field, $table_fields)) {
				throw new UnexistingFieldException;
			}
		}
	}
}

