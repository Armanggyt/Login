<?php
require_once "vendor/autoload.php";
define('CURRENT_DIR', __DIR__);

use Login\Route\Base;

$controller = Base::checkPath();
$page = [];
$page['content'] = $controller->getContent();
$page['title'] = $controller->getTitle();


$loader = new \Twig\Loader\FilesystemLoader(CURRENT_DIR . '/templates');
$twig = new \Twig\Environment($loader, ['autoescape' => FALSE]);

echo $twig->render($controller->getTemplate(), $page);