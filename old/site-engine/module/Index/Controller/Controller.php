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
        $data = $model->main()->getData();

        $view = new View('Index');
        $view->setContent('content');
        $view->setData($data);
        $view->generate();
    }
}