<?php

namespace Lod\User\Authorization;

interface AuthorizationInterface {

    function signIn();
    function getResult();
}