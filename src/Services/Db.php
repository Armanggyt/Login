<?php

namespace Login\Services;

class Db extends \PDO {
    public function __construct() {
        parent::__construct('mysql:host=db;dbname=default', 'user', 'user');
    }
    public function sendQuery($query, $params = []) {
        $q = $this->prepare($query);
        if ($params) {
            $params = is_array($params) ? $params : [$params];
            $q->execute($params);
        } else {
            $q->execute();
        }
        return $q->fetchAll();
    }
}

