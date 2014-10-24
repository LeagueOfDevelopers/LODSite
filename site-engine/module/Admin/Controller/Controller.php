<?php

namespace Admin\Controller;

use Admin\Model\DeleteNewsModel;
use Admin\Model\EditNewsModel;
use Admin\Model\IndexModel;
use Admin\Model\NewsModel;
use Admin\Model\SaveNewsModel;
use Lod\Core\Application;
use Lod\Core\Controller\AbstractController;
use Lod\Core\View\View;

class Controller extends AbstractController {

    function __construct() {}

    public function indexAction() {
        $model = new IndexModel();
        $data = $model->main()->getData();

        $view = new View('Admin');
        $view->setContent('content');
        $view->setData($data);
        $view->generate();
    }

    public function newsAction() {
        $model = new NewsModel();
        $data = $model->main()->getData();

        $view = new View('Admin');
        $view->setTitle('Новости | League Of Developers');
        $view->setContent('news.content');
        $view->setData($data);
        $view->generate();
    }

    public function saveNewsAction() {
        $model = new SaveNewsModel();
        $data = $model->main()->getData();
        Application::setContentType('json');
        echo json_encode($data);
    }

    public function deleteNewsAction() {
        $model = new DeleteNewsModel();
        $data = $model->main()->getData();
        Application::setContentType('json');
        echo json_encode($data);
    }

    public function editNewsAction() {
        $model = new EditNewsModel();
        $data = $model->main()->getData();
        Application::setContentType('json');
        echo json_encode($data);
    }
}