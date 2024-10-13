<?php

session_start();

define('ROOTPATH', __DIR__);

require_once __DIR__ . '/common/route.php';
require_once __DIR__ . '/app/controllers/CompanyController.php';
require_once __DIR__ . '/app/controllers/EmployeeController.php';
require_once __DIR__ . '/app/controllers/MailController.php';

$request_method = $_SERVER['REQUEST_METHOD'];
if ($request_method === 'POST' && isset($_POST['_method']) && in_array($_POST['_method'], ["PUT", "PATCH", "DELETE"])) {
    $request_method  = $_POST['_method'];
}

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

Router::get('/', [CompanyController::class, 'index']);
Router::get('/company', [CompanyController::class, 'index']);
Router::get('/company/create', [CompanyController::class, 'create']);
Router::post('/company', [CompanyController::class, 'store']);
Router::get('/company/{code}/edit', [CompanyController::class, 'edit']);
Router::put('/company', [CompanyController::class, 'update']);

Router::get('/employee/create', [EmployeeController::class, 'create']);
Router::post('/employee', [EmployeeController::class, 'store']);
Router::get('/employee/{id}/edit', [EmployeeController::class, 'edit']);
Router::put('/employee', [EmployeeController::class, 'update']);
Router::delete('/employee/{id}', [EmployeeController::class, 'destroy']);

Router::get('/send-mail', [MailController::class, 'send']);

Router::direct($request_uri, $request_method);