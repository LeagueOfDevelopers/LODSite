<?php

namespace Lod\User\Edit;

use Lod\User\User;
use Lod\User\Validator\FieldsValidator;

class ModifyAccount implements ModifyAccountInterface {

    private $db;
    private $data;

    private $result = false;
    private $id = -1;

    /**
     * @param $db \Lod\Db\LodDatabase
     * @param $data
     */
    function __construct(&$db, $data) {
        $this->db = $db;
        $this->data = $data;
    }

    public function setUserId($id) {
        $this->id = $id;
        return $this;
    }

    public function save() {
        if ($this->id == -1) {
            return;
        }

        $first_name = $this->data['first_name'];
        $second_name = $this->data['last_name'];
        $sex = $this->data['sex'];

        $vk_profile = $this->data['vk_profile'];
        $github_account = $this->data['github_account'];
        $phone = $this->data['phone'];
        $skype = $this->data['skype'];

        $faculty = $this->data['faculty'];
        $university_group = $this->data['university_group'];
        $enrollment_year = $this->data['enrollment_year'];

        $about = $this->data['about'];

        $validator = new FieldsValidator();

        if (!$validator->isNameValid($first_name) || !$validator->isNameValid($second_name)) {
            return;
        }
        if ($sex != 'b' && $sex != 'g') {
            return;
        }
        if (!$validator->isVkProfileValid($vk_profile)) {
            return;
        }
        if (!$validator->isGitHubAccountValid($github_account)) {
            return;
        }
        if (!$validator->isPhoneNumberValid($phone)) {
            return;
        }
        if (!$validator->isSkypeLoginValid($skype)) {
            $skype = '';
        }
        if (!$validator->isFacultyValid($faculty)) {
            $faculty = '';
        }
        if (!$validator->isTextValid($university_group)) {
            $university_group = '';
        }
        if (!$validator->isEnrollmentYearValid($enrollment_year)) {
            $enrollment_year = '';
        }
        if (!$validator->isTextValid($about)) {
            $about = '';
        }

        $user = new User($this->db);
        $user->allocateUserById($this->id);

        $user->setFirstName($first_name);
        $user->setLastName($second_name);
        $user->setSex($sex);
        $user->setVkProfileReference($vk_profile);
        $user->setGitHubAccountName($github_account);
        $user->setPhoneNumber($phone);
        $user->setSkypeAccountName($skype);
        $user->setFaculty($faculty);
        $user->setUniversityGroup($university_group);
        $user->setUniversityEnrollmentYear($enrollment_year);
        $user->setAbout($about);

        $this->result = true;
    }

    /**
     * @return bool
     */
    public function getResult() {
        return $this->result;
    }
}