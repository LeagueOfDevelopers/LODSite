<?php

namespace User\Controller;

use Lod\Core\Application;
use Lod\Core\View\View;
use User\Model\AuthModel;
use Lod\Core\Controller\AbstractController;
use User\Model\LogoutModel;
use User\Model\RegisterModel;

class Controller extends AbstractController {

    function __construct() {}

    public function indexAction() {
        Application::toRoute("/");
        Application::stop();
    }

    public function authAction() {
        $model = new AuthModel();
        $data = $model->main()->getData();
        Application::setContentType('json');
        echo json_encode($data);
    }

    public function logoutAction() {
        $model = new LogoutModel();
        $model->main();
        Application::toRoute("/");
        Application::stop();
    }

    public function registerAction() {
        $model = new RegisterModel();
        $data = $model->main()->getData();

        $view = new View('User');
        $view->setContent('register');
        $view->setData($data);
        $view->generate();
    }
}