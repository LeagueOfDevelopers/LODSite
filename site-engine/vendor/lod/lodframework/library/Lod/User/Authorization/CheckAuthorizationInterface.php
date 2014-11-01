<?php

namespace Lod\User\Authorization;

interface CheckAuthorizationInterface {

    function check();
    function getResult();
    function getUserRow();
}