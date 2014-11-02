<?php

namespace Lod\News;

interface NewsItemInterface {

    function setTableRow($row);
    function allocateById($id);
    function getObject();

    function isEmpty();

    function getId();
    function getUserId();
    function getTitle();
    function getPreviewText();
    function getText();
    function getCountComments();
    function getCountViews();
    function getPhoto();
    function getUserObject();
    function getTime();
    function getDate();

    /**
     * @return \Lod\News\Comments\Comments
     */
    function getCommentsObject();

    function incrementCountViews();
    function incrementCountComments();
    function refreshCountComments();

    function setUserId($id);
    function setTitle($title);
    function setPreviewText($preview);
    function setText($text);
    function setPhoto($photo_link);
}