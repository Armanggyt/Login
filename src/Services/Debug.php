<?php

namespace Login\Services;

class Debug {
    public static function print($var) {
        print "<pre>";
        print_r($var);
        print "</pre>";
    }
}