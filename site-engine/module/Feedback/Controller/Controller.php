<?php

namespace Feedback\Controller;

use Feedback\Model\IndexModel;
use Lod\Core\Controller\AbstractController;
use Lod\Core\View\View;

class Controller extends AbstractController {

    function __construct() {}

    public function indexAction() {
        $model = new IndexModel();
        $data = $model->main()->getData();

        $view = new View('Feedback');
        $view->setContent('content');
        $view->setData($data);
        $view->generate();
    }
}