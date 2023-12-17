<?php
require __DIR__ . '/../../vendor/autoload.php';

use App\Helper\DBConn;

$conn = new DBConn();

$conn->execute(
    "CREATE TABLE IF NOT EXISTS users (
        id serial PRIMARY KEY,
        login character varying(256) DEFAULT NULL,
        password_hash character varying(256) DEFAULT NULL
    );"
);

$conn->execute(
    "CREATE TABLE IF NOT EXISTS currencies (
        id serial PRIMARY KEY,
        digit_code character varying(5) DEFAULT NULL,
        letter_code character varying(5) DEFAULT NULL,
        name character varying(256) DEFAULT NULL,
        course float DEFAULT NULL
    );"
);