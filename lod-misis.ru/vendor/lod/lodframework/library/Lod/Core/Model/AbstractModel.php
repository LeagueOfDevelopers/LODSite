<?php

namespace Lod\Core\Model;

use Lod\Core\Application;
use Lod\Db\LodDatabase;

abstract class AbstractModel implements ModelInterface {

    private $lod_db;
    private $data;
    private $request_params;

    function __construct() {
        $this->lod_db = new LodDatabase(Application::$config['db_options']);
        $this->request_params = Application::$router->getParams();
    }

    protected function getLodDb() {
        return $this->lod_db;
    }

    function getData() {
        return $this->data;
    }

    function setData($data) {
        $this->data = $data;
    }

    function getRequestParams() {
        return $this->request_params;
    }
}