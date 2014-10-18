<?php

namespace Lod\Upload;

use Lod\Core\Application;

class UploadProfileImage {

    private $db;
    private $user;

    private $result = false;
    private $image_link;

    /**
     * @param $db \Lod\Db\LodDatabase
     * @param $user \Lod\User\User
     */
    function __construct(&$db, &$user) {
        $this->db = $db;
        $this->user = $user;
    }

    public function upload() {
        $allowedExts = array("jpg", "jpeg", "gif", "png");
        $file = $_FILES["upload_img"];
        $extension = end(explode('.', $_FILES["upload_img"]['name']));
        if (($file["type"] == "image/gif"
            || $file["type"] == "image/jpeg"
            || $file["type"] == "image/png"
            || $file["type"] == "image/jpg")
            && ($file["size"] < 1024*1024*8)
            && in_array($extension, $allowedExts)) {

            $host = $_SERVER['HTTP_HOST'];
            $relative_path = '/st/img/profile/';
            $name = $this->createName($this->user->getId(), $this->user->getNickName());
            preg_match("/\/(\w+)$/i", $file["type"], $matches);
            $format = $matches[1];
            $file_name = 'http://'.$host.$relative_path.$name.'.'.$format;

            if(is_uploaded_file($file['tmp_name'])) {
                if (copy($file['tmp_name'], Q_PATH.$relative_path.$name.'.'.$format)) {
                    $this->result = true;
                    $this->image_link = $file_name.'?'.rand(10000,99000);
                }
            }

            if ($this->user->isAuth())
                $this->user->setPhoto($this->image_link);

            $resizer = new Upload(Q_PATH.$relative_path.$name.'.'.$format);
            $resizer->resizeImage(200, 200, 'crop');
            $resizer->saveImage(Q_PATH.$relative_path.$name.'.'.$format);
        }
    }

    private function createName($id, $name) {
        return md5($id.$name);
    }

    /**
     * @return string
     */
    public function getImageLink() {
        return $this->image_link;
    }

    /**
     * @return bool
     */
    public function getResult() {
        return $this->result;
    }
}