<?php

require_once __DIR__ . '/Db.php';

use Login\Services\Db;

$db = new Db();

$db->sendQuery('DROP TABLE IF EXISTS users');

$db->sendQuery('CREATE TABLE users IF NOT EXISTS (
    uid INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    data TEXT NULL,
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)');
