<?php

namespace Login\View;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Login\Services\Debug;
use Login\Controller\BaseController;

class BaseView {
    const BASE_DIR = \CURRENT_DIR;
    protected $content = [
        'head' => [],
        'html' => '',
    ];
    protected $template;
    public function __construct(BaseController $controller) {
        $content = $controller->getContent();
        $this->content['title'] = $controller->getTitle();
        $this->template = $controller->getTemplate();
        if (is_string($content)) {
            $this->content['html'] = $content;
        } else {
            if (isset($content['html'])) {
                $this->content['html'] = $content['html'];
            }
            if (isset($content['prefix'])) {
                $this->content['html'] = $content['prefix'] . $this->content['html'];
            }
            if (isset($content['suffix'])) {
                $this->content['html'] = $this->content['html'] . $content['suffix'];
            }
        }
        if (isset($content['css'])) {
            $this->content['head']['css'] = $content['css'];
        }
    }
    public function render() {
        $loader = new FilesystemLoader(self::BASE_DIR . '/templates');
        $twig = new Environment($loader, ['autoescape' => FALSE]);
        echo $twig->render($this->template, $this->content);
    }
}
