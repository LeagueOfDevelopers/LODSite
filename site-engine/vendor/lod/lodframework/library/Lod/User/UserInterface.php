<?php

namespace Lod\User;

use Lod\User\Authorization\CheckAuthorization;

interface UserInterface {

    function setTableRow($row);
    function allocateUserById($id);
    function allocateUserByEmail($email);
    function allocateUserByNickName($nickname);
    function getObject();
    function setCheckAuthorization(CheckAuthorization $class);
    function isAuth();

    function getId();
    function getAccessLevel();
    function getCategoryName();
    function getCategoryColor();
    function getEmail();
    function getPasswordHash();
    function getFirstName();
    function getLastName();
    function getFormatFullName();
    function getViewName();
    function getGitHubAccountName();
    function getGitHubReference();
    function getNickName();
    function getPhoneNumber();
    function getVkProfileReference();
    function getSkypeAccountName();
    function getFaculty();
    function getUniversityGroup();
    function getUniversityEnrollmentYear();
    function getUniversityCourse();
    function getRegisterTime();
    function getLastLoggedTime();
    function getLastLoggedDate();
    function getLastLoggedLater();
    function getViewCount();

    function isBan();
    function unBan();
    function setBan();
    function setResetPasswordKey();

    function setAccessLevel($number);
    function setEmail($email);
    function setPasswordHash($hash);
    function setFirstName($first_name);
    function setLastName($second_name);
    function setGitHubAccountName($name);
    function setNickName($nickname);
    function setPhoneNumber($phone);
    function setVkProfileReference($ref);
    function setSkypeAccountName($account);
    function setFaculty($faculty);
    function setUniversityGroup($group);
    function setUniversityEnrollmentYear($year);
    function incrementViewCount();
    function updateLastLoggedTime();
}