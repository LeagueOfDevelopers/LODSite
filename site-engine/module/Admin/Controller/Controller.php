<?php

namespace Admin\Controller;

use Admin\Model\AdminConfirmModel;
use Admin\Model\DeleteNewsModel;
use Admin\Model\EditNewsModel;
use Admin\Model\IndexModel;
use Admin\Model\NewsModel;
use Admin\Model\OrdersModel;
use Admin\Model\SaveNewsModel;
use Admin\Model\SaveUserCategoryModel;
use Admin\Model\SignInByUserModel;
use Admin\Model\ToggleBanModel;
use Admin\Model\UsersModel;
use Lod\Core\Application;
use Lod\Core\Controller\AbstractController;
use Lod\Core\View\View;

class Controller extends AbstractController {

    function __construct() {}

    public function indexAction() {
        $model = new IndexModel();
        $data = $model->main()->getData();
        $data['menu_flag'] = 'index';

        $view = new View('Admin');
        $view->setContent('content');
        $view->setData($data);
        $view->generate();
    }

    public function newsAction() {
        $model = new NewsModel();
        $data = $model->main()->getData();
        $data['menu_flag'] = 'news';

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

    public function usersAction() {
        $model = new UsersModel();
        $data = $model->main()->getData();
        $data['menu_flag'] = 'users';

        $view = new View('Admin');
        $view->setTitle('Пользователи | League Of Developers');
        $view->setContent('users.content');
        $view->setData($data);
        $view->generate();
    }

    public function saveUserCategoryAction() {
        $model = new SaveUserCategoryModel();
        $data = $model->main()->getData();
        Application::setContentType('json');
        echo json_encode($data);
    }

    public function signInByUserAction() {
        $model = new SignInByUserModel();
        $data = $model->main()->getData();
        Application::setContentType('json');
        echo json_encode($data);
    }

    public function toggleBanAction() {
        $model = new ToggleBanModel();
        $data = $model->main()->getData();
        Application::setContentType('json');
        echo json_encode($data);
    }

    public function adminConfirmAction() {
        $model = new AdminConfirmModel();
        $data = $model->main()->getData();
        Application::setContentType('json');
        echo json_encode($data);
    }

    public function ordersAction() {
        $model = new OrdersModel();
        $data = $model->main()->getData();
        $data['menu_flag'] = 'orders';

        $view = new View('Admin');
        $view->setTitle('Заказы | League Of Developers');
        $view->setContent('orders.content');
        $view->setData($data);
        $view->generate();
    }
}