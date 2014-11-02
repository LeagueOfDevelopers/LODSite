<?php

namespace Index\Controller;

use Index\Model\IndexModel;
use Lod\Core\Application;
use Lod\Core\Controller\AbstractController;
use Lod\Core\View\View;

class Controller extends AbstractController {

    function __construct() {}

    public function indexAction() {
        $model = new IndexModel();
        $model->main();

        $view = new View('Index');
        $view->setContent('content');
        $view->generate();
    }
}