<?php
namespace Login\Controller;
use Login\Services\Auth;
use Login\Services\Debug;
class BaseController {
    protected $title;
    protected $content;
    protected $auth;
    protected $template = 'index';

    public function __construct() {
        $this->auth = Auth::checkAuth();
        $classPath = explode('\\', strtolower(get_class($this)));
        $className = end($classPath);
        if (file_exists(\CURRENT_DIR . '/templates/' . $className . '.html.twig' )) {
            $this->setTemplate($className);
        }
    }

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
        return "<!DOCTYPE html><html><head><title>{$this->title}</title><link rel=\"stylesheet\" type=\"text/css\" href=\"/assets/main.css\"></head>";
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

    public function getContent() {
        return $this->content;
    }
    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getTemplate() {
        return $this->template . '.html.twig';
    }

    public function setTemplate($template) {
        $this->template = $template;
    }
}