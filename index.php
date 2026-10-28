<?php
require_once "vendor/autoload.php";
define('CURRENT_DIR', __DIR__);

use Login\Route\Base;
use Login\View\BaseView;

$controller = Base::checkPath();
$view = new BaseView($controller);
$view->render();