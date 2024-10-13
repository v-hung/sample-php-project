<?php

require_once ROOTPATH . '/app/models/Model.php';

class Employee extends Model
{
    protected $company_code;
    protected $id;
    protected $name;
    protected $email;

    public function __construct($company_code = null, $name = null, $email = null)
    {
        $this->company_code = $company_code;
        $this->name = $name;
        $this->email = $email;
    }

    public static function count($company_code) {
        $sql = "SELECT COUNT(*) AS employee_count FROM {$company_code}_employees";
        $data = query($sql);

        return $data["0"]['employee_count'];
    }

    public static function getAll($company_code) {
        $sql = "SELECT id, name, email FROM {$company_code}_employees";
        $data = query($sql);

        return $data;
    }

    public static function get($company_code, $id) {
        $sql = "SELECT id, name, email FROM {$company_code}_employees WHERE id = :id";
        $params = [
            ':id' => $id
        ];
        $data = query($sql, $params);

        return $data[0];
    }

    public function save() {
        $sql = "INSERT INTO {$this->company_code}_employees (name, email) VALUES (:name, :email)";
        $params = [
            ':name' => $this->name,
            ':email' => $this->email
        ];

        if (execute($sql, $params)) {
            return true;
        }

        return false;
    }

    public function update() {
        $sql = "UPDATE {$this->company_code}_employees SET name = :name, email = :email WHERE id = :id";
        $params = [
            ':name' => $this->name,
            ':email' => $this->email,
            ':id' => $this->id
        ];

        if (execute($sql, $params)) {
            return true;
        }

        return false;
    }

    public function delete() {
        $sql = "DELETE FROM {$this->company_code}_employees WHERE id = :id;";
        $params = [
            ':id' => $this->id
        ];

        if (execute($sql, $params)) {
            return true;
        }

        return false;
    }
}
