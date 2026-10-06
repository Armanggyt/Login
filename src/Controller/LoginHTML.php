<?php
namespace Login\Controller;

class LoginHTML extends BaseController {
    public function form() {
        $this->title = "Login";
        $this->content = '<form action="/loginSubmit" method="post">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" name="LoginSubmit">
            </form>';
    }
}