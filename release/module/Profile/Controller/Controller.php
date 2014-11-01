<?php

namespace Profile\Controller;

use Lod\Core\Application;
use Profile\Model\ChangePasswordModel;
use Profile\Model\EditModel;
use Profile\Model\IndexModel;
use Lod\Core\Controller\AbstractController;
use Lod\Core\View\View;
use Profile\Model\SaveModifiedModel;
use Profile\Model\SaveNewPasswordModel;
use Profile\Model\UploadProfileImageModel;

class Controller extends AbstractController {

    function __construct() {}

    public function indexAction() {
        $model = new IndexModel();
        $data = $model->main()->getData();

        /** @var \Lod\User\User $user */
        $user = $data['profile_user'];

        $view = new View('Profile');
        $view->setTitle($user->getViewName().' | League Of Developers');
        $view->setContent('content');
        $view->setData($data);
        $view->generate();
    }

    public function editAction() {
        $model = new EditModel();
        $data = $model->main()->getData();

        $view = new View('Profile');
        $view->setTitle('Редактирование профиля | League Of Developers');
        $view->setContent('edit.main');
        $view->setData($data);
        $view->generate();
    }

    public function saveModifiedAction() {
        $model = new SaveModifiedModel();
        $data = $model->main()->getData();
        Application::setContentType('json');
        echo json_encode($data);
    }

    public function uploadProfileImageAction() {
        $model = new UploadProfileImageModel();
        $data = $model->main()->getData();
        Application::setContentType('json');
        echo json_encode($data);
    }

    public function changePasswordAction() {
        $model = new ChangePasswordModel();
        $data = $model->main()->getData();

        $view = new View('Profile');
        $view->setTitle('Смена пароля | League Of Developers');
        $view->setContent('change_password.main');
        $view->setData($data);
        $view->generate();
    }

    public function saveNewPasswordAction() {
        $model = new SaveNewPasswordModel();
        $data = $model->main()->getData();
        Application::setContentType('json');
        echo json_encode($data);
    }
}