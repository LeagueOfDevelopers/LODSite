<?php

namespace Lod\Core\Model;

interface ModelInterface {

    public function main();
    public function setData($data);
    public function getData();
    public function getRequestParams();
}