<?php

namespace Login\Services;

use Login\Entity\User;

class Auth {
    public static function checkAuth(){
        if (!isset($_COOKIE['PHPSESSID']) ) {
            return FALSE;
        }
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $sessionId = session_id();
        $db = new Db(); 
        $sth =$db->prepare('SELECT id FROM sessions WHERE session_id = ?');
        $sth->execute([$sessionId]);
        $sessionData =$sth->fetch(Db::FETCH_OBJ);
        return (bool) $sessionData;


    }

    public static function authUser($uid){
        $db = new Db();
        global $user;
        if (self::checkAuth()){
            return $user;
        }
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $sessionId = session_id();
        $sth = $db->prepare('INSERT INTO sessions (uid, session_id) VALUES (?, ?)');
        $sth->execute([$uid, $sessionId]);
        $user = User::load($uid);
        return $user;
    }
}