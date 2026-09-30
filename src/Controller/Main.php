<?php
namespace Login\Controller;

use Login\Services\Debug;


class Main extends BaseController {
    public function page() {
        session_start();
        Debug::print(session_id());
        $this->content = 'This is a front <b>Page</b>';
    }
}