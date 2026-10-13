<?php

require_once "vendor/autoload.php";

use Login\Services\Db;

$db = new Db();

$db->sendQuery('CREATE TABLE IF NOT EXISTS users (
    uid INT AUTO_INCREMENT PRIMARY KEY
)');
$db->sendQuery("TRUNCATE TABLE users;");
$db->sendQuery("ALTER TABLE users ADD COLUMN IF NOT EXISTS name VARCHAR(100) NOT NULL");
$db->sendQuery("ALTER TABLE users ADD COLUMN IF NOT EXISTS password VARCHAR(255) NOT NULL");
$db->sendQuery("ALTER TABLE users ADD COLUMN IF NOT EXISTS email VARCHAR(255) NOT NULL");
$db->sendQuery("ALTER TABLE users ADD COLUMN IF NOT EXISTS data TEXT NULL");
$db->sendQuery("ALTER TABLE users ADD COLUMN IF NOT EXISTS created TIMESTAMP DEFAULT CURRENT_TIMESTAMP");

$db->sendQuery('CREATE TABLE IF NOT EXISTS sessions (
    uid INT NOT NULL
)');
$db->sendQuery("TRUNCATE TABLE sessions;");
$db->sendQuery("ALTER TABLE sessions ADD COLUMN IF NOT EXISTS session_id VARCHAR(255) NOT NULL");
$db->sendQuery("ALTER TABLE sessions ADD COLUMN IF NOT EXISTS id INT ");
$db->sendQuery("ALTER TABLE sessions ADD COLUMN IF NOT EXISTS data TEXT NULL");
