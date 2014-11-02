<?php

namespace Lod\User\Edit;

interface ModifyAccountInterface {

    function setUserId($id);
    function save();
    function getResult();
}