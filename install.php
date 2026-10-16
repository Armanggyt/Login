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
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY 
)');
$db->sendQuery("TRUNCATE TABLE sessions;");
$db->sendQuery("ALTER TABLE sessions ADD COLUMN IF NOT EXISTS session_id VARCHAR(255) NOT NULL");
$db->sendQuery("ALTER TABLE sessions ADD COLUMN IF NOT EXISTS uid INT ");
$db->sendQuery("ALTER TABLE sessions ADD COLUMN IF NOT EXISTS data TEXT NULL");

$db->sendQuery('CREATE TABLE IF NOT EXISTS tokens (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY 
)');
$db->sendQuery("TRUNCATE TABLE tokens;");
$db->sendQuery("ALTER TABLE tokens ADD COLUMN IF NOT EXISTS token VARCHAR(255) NOT NULL");
$db->sendQuery("ALTER TABLE tokens ADD COLUMN IF NOT EXISTS email VARCHAR(255) NOT NULL");

