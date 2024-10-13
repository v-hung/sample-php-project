<?php

require_once ROOTPATH . '/app/models/Model.php';

class Company extends Model {
    protected $id;
    protected $code;
    protected $name;

    public function __construct($code = null, $name = null) {
        $this->code = $code;
        $this->name = $name;
    }

    public static function getAll() {
        $sql = "SELECT id, code, name FROM companies";
        $data = query($sql);

        foreach ($data as $index => $company) {
            $data[$index]['employee_count'] = Employee::count($company['code']);
        }

        return $data;
    }

    public static function get($code) {
        $sql = "SELECT id, code, name FROM companies WHERE code = :code";
        $params = [
            ':code' => $code
        ];
        $data = query($sql, $params);

        return $data[0];
    }

    public function save () {
        $sql = "INSERT INTO companies (code, name) VALUES (:code, :name)";
        $params = [
            ':code' => $this->code,
            ':name' => $this->name
        ];

        if (execute($sql, $params)) {

            $this->createEmployeeTable();

            return true;
        }

        return false;
    }

    public function update() {
        $sql = "UPDATE companies SET name = :name WHERE id = :id";
        $params = [
            ':name' => $this->name,
            ':id' => $this->id
        ];

        if (execute($sql, $params)) {
            return true;
        }

        return false;
    }

    public function delete() {
        $sql = "DELETE FROM companies WHERE id = :id;";
        $params = [
            ':id' => $this->id
        ];

        if (execute($sql, $params)) {

            $this->deleteEmployeeTable();

            return true;
        }

        return false;
    }

    public function createEmployeeTable() {
        $tableName = strtolower($this->code) . "_employees";

        $sql = "CREATE TABLE IF NOT EXISTS $tableName (
            id SERIAL PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";

        if (execute($sql)) {
            return true;
        }

        return false;
    }

    public function deleteEmployeeTable() {
        $tableName = strtolower($this->code) . "_employees";

        $sql = "DROP TABLE IF EXISTS $tableName";

        if (execute($sql)) {
            return true;
        }

        return false;
    }
}