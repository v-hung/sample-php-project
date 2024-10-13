<?php

require_once __DIR__ . '/../models/Company.php';

class CompanyController {
    public function index() {
        $companies = Company::getAll();

        require __DIR__ . '/../views/company/index.php';
    }

    public function create() {
        require __DIR__ . '/../views/company/create.php';
    }

    public function store() {
        $newCompany = new Company();
        $newCompany->code = $_POST['code'];
        $newCompany->name = $_POST['name'];

        if ($newCompany->save()) {
            header('Location: /company');
            exit;
        }
    }

    public function edit($code) {
        $company = Company::get($code);

        $employees = Employee::getAll($company['code']);

        require __DIR__ . '/../views/company/edit.php';
    }

    public function update() {
        $company = new Company();
        $company->id = $_POST['id'];
        $company->name = $_POST['name'];

        if ($company->update()) {
            header("Location: /");
            exit;
        }
    }

    public function destroy($id) {
        $newCompany = new Company();
        $newCompany->id = $id;
        $newCompany->code = $_POST['code'];

        if ($newCompany->delete()) {
            header('Location: /company');
            exit;
        }
    }
}