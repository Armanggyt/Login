<?php

namespace Login\Route;

class Base {
    public static $paths = [
        '/' => ['\Login\Controller\Main', 'page'],
        '/register' => ['\Login\Controller\Register', 'form'],
        '/submit' => ['\Login\Controller\RegSubmit', 'submit'],
        '404' => ['\Login\Controller\Error', 'notFound'],
        '403' => ['\Login\Controller\Error', 'accessDenied'],
    ];
    public static function checkPath() {
        $requestUri = $_SERVER['REQUEST_URI'];
        $path = parse_url($requestUri, PHP_URL_PATH);

        if (isset(self::$paths[$path])) {
            $pathInfo = self::$paths[$path];
        }
        else {
            $pathInfo = self::$paths['404'];
        }
        $controller = new $pathInfo[0]();
        $controller->{$pathInfo[1]}();
        return $controller;
    }
}