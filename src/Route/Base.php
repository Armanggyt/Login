<?php

namespace Login\Route;

use Login\Services\Debug;

class Base {
    public static $paths = [
        'GET' => [
            '/' => ['\Login\Controller\Main', 'page'],
            '/register' => ['\Login\Controller\Register', 'form'],
            '/regsubmit' => ['\Login\Controller\Register', 'submit'],
            '/login' => ['\Login\Controller\Login', 'form'],
            '/loginSubmit' => ['\Login\Controller\Login', 'submit'],
            '/reset' => ['\Login\Controller\Login', 'resetFormPage'],
            '/reset-password' => ['\Login\Controller\ResetPassword', 'form'],
            '404' => ['\Login\Controller\Error', 'notFound'],
            '403' => ['\Login\Controller\Error', 'accessDenied'],
        ],
        'POST' => [
            '/reset' => ['\Login\Controller\Login', 'sendResetEmail'],
            '/regsubmit' => ['\Login\Controller\Register', 'submit'],
            '/loginSubmit' => ['\Login\Controller\Login', 'submit'],
            '/update-password' => ['\Login\Controller\ResetPassword', 'updatePassword'],
        ]
    ];

    public static function checkPath() {
        $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $requestUri = $_SERVER['REQUEST_URI'];
        $path = parse_url($requestUri, PHP_URL_PATH);

        if (isset(self::$paths[$requestMethod][$path])) {
            $pathInfo = self::$paths[$requestMethod][$path];
        } else {
            $pathInfo = self::$paths['GET']['404'];
        }
        $controller = new $pathInfo[0]();
        $controller->{$pathInfo[1]}();
        return $controller;
    }
}