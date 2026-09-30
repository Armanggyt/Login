<?php
namespace Login\Controller;

class RegHTML extends BaseController {
    public function form() {
        $this->title = "Register";
        $this->content = '<form action="/regsubmit" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <input type="submit" name="RegSubmit">
        </form>';
        $this->html();
}
}