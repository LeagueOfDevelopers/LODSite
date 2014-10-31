<?php

namespace Portfolio\Controller;

use Portfolio\Model\IndexModel;
use Lod\Core\Controller\AbstractController;
use Lod\Core\View\View;

class Controller extends AbstractController {

    function __construct() {}

    public function indexAction() {
        $model = new IndexModel();
        $data = $model->main()->getData();

        $view = new View('Portfolio');
        $view->setContent('content');
        $view->setData($data);
        $view->generate();
    }
}