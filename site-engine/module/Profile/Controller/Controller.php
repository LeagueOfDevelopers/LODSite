<?php

namespace Profile\Controller;

use Lod\Core\Application;
use Profile\Model\IndexModel;
use Lod\Core\Controller\AbstractController;
use Lod\Core\View\View;

class Controller extends AbstractController {

    function __construct() {}

    public function indexAction() {
        $model = new IndexModel();
        $data = $model->main()->getData();

        $view = new View('Profile');
        $view->setContent('content');
        $view->setData($data);
        $view->generate();
    }
}