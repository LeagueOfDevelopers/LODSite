<?php

namespace Err404\Controller;

use Lod\Core\Controller\AbstractController;
use Lod\Core\View\View;

class Controller extends AbstractController {

    function __construct() {}

    public function indexAction() {
        $view = new View('Err404');
        $view->setContent('content');
        $view->generate();
    }
}