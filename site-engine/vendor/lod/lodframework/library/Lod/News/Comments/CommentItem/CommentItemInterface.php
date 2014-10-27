<?php

namespace Lod\News\Comments\CommentItem;

interface CommentItemInterface {

    function setTableRow($row);
    function allocateById($id);
    function getObject();

    function isEmpty();

    function getId();
    function getUserId();
    function getNewsId();
    function getText();
    function getUserObject();
    function getTime();
    function getDate();
    function getParentId();
    function getParentViewName();

    function setUserId($id);
    function setParentId($id);
    function setText($text);
}