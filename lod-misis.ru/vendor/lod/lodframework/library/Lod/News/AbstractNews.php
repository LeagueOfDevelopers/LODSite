<?php

namespace Lod\News;

abstract class AbstractNews {

    private $db;

    /**
     * @param $db \Lod\Db\LodDatabase
     */
    function __construct(&$db) {
        $this->db = $db;
    }
}