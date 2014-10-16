<?php

namespace User\Controller;

use Lod\Core\Application;
use Lod\Core\View\View;
use User\Model\AuthModel;
use Lod\Core\Controller\AbstractController;
use User\Model\CheckEmailModel;
use User\Model\CheckLoginModel;
use User\Model\ConfirmAccountModel;
use User\Model\LogoutModel;
use User\Model\RegisterModel;
use User\Model\SignUpModel;

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

    public function signUpAction() {
        $model = new SignUpModel();
        $data = $model->main()->getData();
        Application::setContentType('json');
        echo json_encode($data);
    }

    public function checkLoginAction() {
        $model = new CheckLoginModel();
        $data = $model->main()->getData();
        Application::setContentType('json');
        echo json_encode($data);
    }

    public function checkEmailAction() {
        $model = new CheckEmailModel();
        $data = $model->main()->getData();
        Application::setContentType('json');
        echo json_encode($data);
    }

    public function confirmAccountAction() {
        $model = new ConfirmAccountModel();
        $data = $model->main()->getData();
        if ($data['result']) {
            Application::toRoute("/user/register?confirmed");
        } else {
            Application::toRoute("/");
        }
        Application::stop();
    }
}