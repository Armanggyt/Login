<?php
namespace Login\Controller;

use Login\Services\Debug;


class Main extends BaseController {

    public function page() {
        $this->title = 'Front page';
        if ($this->auth) {
            $this->content = 'This is a front <b>Page</b> authorized';
        } else {
            $this->content = 'This is s not authorized front page';
        }
    }
}
