<?php
namespace Login\Controller;

use Login\Services\Debug;

class Main extends BaseController {
    public function page() {
        $session = new Session();
        $this->content = 'This is a front <b>Page</b>';
    }
}

class Session {
    public $session_id;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->session_id = session_id();
        
        $db = new \Login\Services\Db(); 
        
        $sth =$db->prepare('SELECT * FROM sessions WHERE session_id = ?');
        $sth->execute([$this->session_id]);
        
        $sessionData =$sth->fetch(\PDO::FETCH_ASSOC);
        
        if ($sessionData) {
            $_SESSION['uid'] =$sessionData['uid'];
            echo "Դուք արդեն մուտք եք գործել:";
        } else {
          header('Location: /register');
            exit;        }
    }
}