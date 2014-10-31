<?php

namespace Orders\Controller;

use Orders\Model\AddOrderModel;
use Orders\Model\IndexModel;
use Lod\Core\Controller\AbstractController;
use Lod\Core\View\View;

class Controller extends AbstractController {

    function __construct() {}

    public function indexAction() {
        $model = new IndexModel();
        $data = $model->main()->getData();

        $view = new View('Orders');
        $view->setContent('content');
        $view->setData($data);
        $view->generate();
    }

    public function addOrderAction() {
        (new AddOrderModel())->main();
    }

    public function successAction() {
        $model = new IndexModel();
        $data = $model->main()->getData();

        $view = new View('Orders');
        $view->setContent('success.content');
        $view->setData($data);
        $view->generate();
    }
}