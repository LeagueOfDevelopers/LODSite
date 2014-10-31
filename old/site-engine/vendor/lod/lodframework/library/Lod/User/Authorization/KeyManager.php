<?php

namespace Lod\User\Authorization;

class KeyManager {

    function __construct() {}

    public function createKey($id, $access_key) {
        $key = base64_encode($id).'|'.base64_encode($access_key);
        $key = str_replace('=', '_', $key);
        $key = urlencode($key);
        return $key;
    }

    public function getPair($key) {
        $key = urldecode($key);
        $key = str_replace('_', '=', $key);
        $arr = explode('|', $key);
        $user_id = base64_decode($arr[0]);
        $access_key = base64_decode($arr[1]);
        return array(
            $user_id,
            $access_key
        );
    }
}