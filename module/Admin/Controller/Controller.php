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
use Admin\Model\TeamModel;
use Admin\Model\TreckerModel;
use Admin\Model\ApproveOrderModel;
use Admin\Model\ModifyProjectModel;
use Admin\Model\DelUserFromProjectModel;
use Admin\Model\ShowCartProjectModel;
use Admin\Model\EditProjectModel;
use Admin\Model\SaveChangesProjectModel;
use Admin\Model\CreateProjectByHandModel;
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
    // Трекер action
    // Показаьть все проекты и пользователей которые на нем
    public function trekerAction() {
        $model = new TreckerModel();
        $data = $model->main()->getData();
        $data['menu_flag'] = 'teams';

        $view = new View('Admin');
        $view->setTitle('Команды | League Of Developers');
        $view->setContent('teams');
        $view->setData($data);
        $view->generate(); 
    } 
    //создать проект

    public function createProjectByHandAction(){
        $model = new CreateProjectByHandModel();
        $data = $model->main()->getData();
        $data['menu_flag'] = 'teams';
        
        $view = new View('Admin');
        $view->setTitle('Команды | League Of Developers');
        $view->setContent('createProject');
        $view->setData($data);
        $view->generate(); 
    }
    //редактировать проект
    public function editProjectAction() {
        $model = new EditProjectModel();
        $data = $model->main()->getData();
        $data['menu_flag'] = 'teams';

        $view = new View('Admin');
        $view->setTitle('Команды | League Of Developers');
        $view->setContent('editProject');
        $view->setData($data);
        $view->generate();  
    }
    //сохранить проект
    public function saveChangesProjectAction() {
        $model = new saveChangesProjectModel();
        $data = $model->main()->getData()['id'];
        Application::toRoute("/adminium/showCartProject?id=".$data);
    }
    //показать карточку проекта
    public function showCartProjectAction() {
        $model = new ShowCartProjectModel();
        $data = $model->main()->getData();
        $data['menu_flag'] = 'teams';

        $view = new View('Admin');
        $view->setTitle('Команды | League Of Developers');
        $view->setContent('showProject');
        $view->setData($data);
        $view->generate();  
    }
    //одобрить проект
    public function approveOrderAction() {
        $model = new ApproveOrderModel();
        $data = $model->main()->getData();

        $view = new View('Admin');
        $view->setTitle('Проект| League Of Developers');
        $view->setContent('make.project');
        $view->setData($data);
        $view->generate(); 
    }
    //создать проект и добавить его в трекер
    public function createProjectAction() {
            $model = new ModifyProjectModel();
            $model->main()->getData();
            Application::toRoute("/adminium/maketeam");
    }

    public function deleteUserFromProjectAction() {
        $model = new DelUserFromProjectModel();
        $data = $model->main()->getData()['id'];
        Application::toRoute("/adminium/showCartProject?id=".$data);
    }

    public function maketeamAction() {
       $model = new TreckerModel();
        $data = $model->main()->getData();
        $data['menu_flag'] = 'teams';
        $view = new View('Admin');
        $view->setTitle('Команды | League Of Developers');
        $view->setContent('teams');
        $view->setData($data);
        $view->generate();

       /* $model = new TeamModel();
        $data = $model->main()->getData();
        $data['menu_flag'] = 'teams';
        
        $view = new View('Admin');
        $view->setTitle('Команды | League Of Developers');
        $view->setContent('teams');
        $view->setData($data);
        $view->generate();*/ 
    }
    //------------------------------------------------------------------------
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