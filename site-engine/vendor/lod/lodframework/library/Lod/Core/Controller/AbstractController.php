<?php

namespace Lod\Core\Controller;

abstract class AbstractController {

    private $params;

    function __construct() {}

    public function indexAction() {}

    public function setParams($params) {
        $this->params = $params;
    }

    public function getParams() {
        return $this->params;
    }
}