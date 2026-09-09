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
        // $_SERVER['REQUEST_URI']... 

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