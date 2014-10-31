<?php

namespace News\Controller;

use Lod\Core\Application;
use Lod\News\NewsItem;
use News\Model\AddCommentModel;
use News\Model\DeleteCommentModel;
use News\Model\IndexModel;
use Lod\Core\Controller\AbstractController;
use Lod\Core\View\View;

class Controller extends AbstractController {

    function __construct() {}

    public function indexAction() {
        $model = new IndexModel();
        $data = $model->main()->getData();

        /** @var NewsItem $news_item */
        $news_item = $data['news_item'];

        $view = new View('News');
        $view->setTitle("{$news_item->getTitle()} | League Of Developers");
        $view->setContent('main');
        $view->setData($data);
        $view->generate();
    }

    public function addCommentAction() {
        $model = new AddCommentModel();
        $data = $model->main()->getData();
        Application::setContentType('json');
        echo json_encode($data);
    }

    public function deleteCommentAction() {
        $model = new DeleteCommentModel();
        $data = $model->main()->getData();
        Application::setContentType('json');
        echo json_encode($data);
    }
}