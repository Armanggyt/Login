<?php
namespace Login\Controller;

class Register extends BaseController {
    public function form() {
        $this->title = 'User register page';
        $this->content = '<form action="/register-submit" method="post"></form>';
    }
}