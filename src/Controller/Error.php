<?php
namespace Login\Controller;

class Error extends BaseController {
    public function notFound() {
        $this->content = 'Page not found';
    }
}