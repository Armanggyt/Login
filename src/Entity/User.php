<?php

namespace Login\Entity;

use Login\Services\Db;

class User {
    protected $uid;
    protected $email;
    protected $name;
    protected $password;
    protected $created;
    protected $data;

    public function setCredentials($username, $password)
    {
        $this->email = $username;
        $this->pass = $password;
    }
    public function extractData($user) {
        foreach($user as $key => $value) {
            if (property_exists($this, $key)){
                $this->{$key} = $value;
            }
        }
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
        $db = new Db();
        $users = $db->sendQuery('SELECT * FROM users where email=?', [$email]);
        if (empty($users)) {
            return FALSE;
        }
        $userData = reset($users);
        $user = new static();
        $user->extractData($userData);
        return $user;
    }

    public function checkPassword($password) {
        return password_verify($password, $this->password);
    }
}