<?php

namespace Login\Entity;

use Login\Services\Db;

class User {
    protected $uid;
    protected $email;
    protected $name;
    protected $pass;
    protected $created;
    protected $data;

    public function setCredentials($username, $password)
    {
        $this->email = $username;
        $this->pass = $password;
    }
    public function extractData($user) {
        $this->uid = $user['uid'];
        $this->name = $user['name'];
    }
    public static function load($uid) {
        $db = new Db();
        $users = $db->sendQuery('SELECT * FROM users where uid=?', [$uid]);
        if (empty($users)) {
            return FALSE;
        }
        $userData = reset($users);
        $user = new static();
        $user->extractData($userData);
        return $user;
    }

    public static function loadByEmail($email) {
                // grel.
    }
}