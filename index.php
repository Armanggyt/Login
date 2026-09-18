<?php
require_once "vendor/autoload.php";
use Login\Route\Base;

$controller = Base::checkPath();
$controller->html();
