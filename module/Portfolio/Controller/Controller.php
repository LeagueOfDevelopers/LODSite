<?php

namespace Portfolio\Controller;

use Portfolio\Model\IndexModel;
use Portfolio\Model\ViewOnePersonModel;
use Portfolio\Model\ShowCartProjectModel;
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
    public function personAction() {
        $model = new ViewOnePersonModel();
        $data = $model->main()->getData();
        $view = new View('Portfolio');
        $view->setContent('person.main');
        $view->setData($data);
        $view->generate();
    }

    public function showCartProjectAction() {
        $model = new ShowCartProjectModel();
        $data = $model->main()->getData();
        
        $view = new View('Portfolio');
        $view->setTitle('Команды | League Of Developers');
        $view->setContent('showcart');
        $view->setData($data);
        $view->generate();  
    }
}