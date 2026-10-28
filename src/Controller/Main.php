<?php
namespace Login\Controller;

use Login\Services\Debug;


class Main extends BaseController {

    public function page() {
        $this->title = 'Front page';
        if ($this->auth) {
            $this->content = [
                'html' => 'This is a front <b>Page</b> authorized',
                'prefix' => '<div>',
                'suffix' => '</div>',
                'css' => ['assets/m2.css'],
            ]; 
        } else {
            $this->content = [ 
                'html' => 'This is s not authorized front page',
                'prefix' => '<div>',
                'suffix' => '</div>'
            ];
        }
    }
}
