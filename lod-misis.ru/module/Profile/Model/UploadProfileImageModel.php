<?php

namespace Profile\Model;

use Lod\Core\Model\AbstractModel;
use Lod\Upload\UploadProfileImage;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;

class UploadProfileImageModel extends AbstractModel {

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        if (!$user->isAuth()) {
            $result = array(
                'result' => false
            );
            $this->setData($result);
            return $this;
        }

        $uploader = new UploadProfileImage($this->getLodDb(), $user);
        $uploader->upload();

        if ($uploader->getResult()) {
            $result = array(
                'result' => $uploader->getResult(),
                'image_link' => $uploader->getImageLink()
            );
        } else {
            $result = array(
                'result' => false
            );
        }
        $this->setData($result);

        return $this;
    }
}