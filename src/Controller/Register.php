<?php
namespace Login\Controller;

class Register extends BaseController {
    public function form() {
        $this->title = 'User register page';
        $this->content = '<form action="/submit" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirm_password" placeholder="Confirm Password">
        <button type="submit" name="submit">Register</button>
      </form>';
    }
}
