<?php
namespace Login\Controller;

class BaseController {
    protected $title;
    protected $content;
    /**
     * Full page html.
     */
    public function html(){
        print $this->head();
        print $this->header();
        print $this->content();
        print $this->footer();
    }

    /**
     * Before <body>
     */
    public function head() {
        return "<!DOCTYPE html><html><head><title>{$this->title}</title></head>";
    }

    /**
     * Page header
     */
    public function header() {
        return '<body>';
    }
    
    
    /**
     * Page header
     */
    public function content() {
        return "<div id=\"page-content\">{$this->content}</div>";
    }


    /**
     * Page header
     */
    public function footer() {
        return '</body>';
    }
}