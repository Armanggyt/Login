<?php
namespace Login\Controller;
use Login\route\Base;
class Laravel {
    public function generateToken() {
        $token = bin2hex(random_bytes(32));
        echo $token;
    }
}
