<?php

namespace Login\Entity; 

class User {
    protected $uid;
    protected $email;
    protected $pass;
    protected $created;
    protected $data;
   public function setCredentials($username, $password) {
        $this->uid = $username;
        $this->pass = $password;
   }
};