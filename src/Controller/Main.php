<?php
namespace Login\Controller;

class Main extends BaseController {
    public function page() {
        $this->content = 'This is a front <b>Page</b>';
    }
}