<?php

namespace Login\Route;

class Base {
    public static $paths = [
        '/' => ['\Login\Controller\Main', 'page'],
        '/register' => ['\Login\Controller\Register', 'form'],
        '404' => ['\Login\Controller\Error', 'notFound'],
        '403' => ['\Login\Controller\Error', 'accessDenied'],
    ];
    public static function checkPath() {
$requestUri = $_SERVER['REQUEST_URI'];

$path = parse_url($requestUri, PHP_URL_PATH);

echo htmlspecialchars($path);

        $path = '/';

        // end of logic.

        if (isset(self::$paths[$path])) {
            $pathInfo = self::$paths[$path];
            $controller = new $pathInfo[0]();
            return $controller->{$pathInfo[1]}();
        }
        else {
            return FALSE;
        }
    }
}