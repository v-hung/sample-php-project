<?php

require_once __DIR__ . '/../models/Employee.php';

class EmployeeController {
    public function index() {
        $company_code = $_GET['company_code'];

        $employees = Employee::getAll($company_code);

        require __DIR__ . '/../views/employee/index.php';
    }

    public function create() {
        $company_code = $_GET['company_code'];

        require __DIR__ . '/../views/employee/create.php';
    }

    public function store() {
        $newEmployee = new Employee();
        $newEmployee->company_code = $_POST['company_code'];
        $newEmployee->name = $_POST['name'];
        $newEmployee->email = $_POST['email'];

        if ($newEmployee->save()) {
            header("Location: /company/{$_POST['company_code']}/edit");
            exit;
        }
    }

    public function edit($id) {
        $company_code = $_GET['company_code'];

        $employee = Employee::get($company_code, $id);

        require __DIR__ . '/../views/employee/edit.php';
    }

    public function update() {
        $employee = new Employee();
        $employee->company_code = $_POST['company_code'];
        $employee->id = $_POST['id'];
        $employee->name = $_POST['name'];
        $employee->email = $_POST['email'];

        if ($employee->update()) {
            header("Location: /company/{$_POST['company_code']}/edit");
            exit;
        }
    }

    public function destroy($id) {
        $employee = new Employee();
        $employee->company_code = $_POST['company_code'];
        $employee->id = $id;

        if ($employee->delete()) {
            header("Location: /company/{$_POST['company_code']}/edit");
            exit;
        }
    }
}