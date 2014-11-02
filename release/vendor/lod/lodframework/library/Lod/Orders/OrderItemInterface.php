<?php

namespace Lod\Orders;

interface OrderItemInterface {

    function setTableRow($row);
    function allocateById($id);
    function getObject();

    function isEmpty();

    function getId();
    function getFio();
    function getEmail();
    function getPhone();
    function getType();
    function getFinishTime();
    function getFinishDate();
    function getFileLink();
    function getDescription();
    function getCreateTime();
    function getCreateDate();

    function setFileLink($link);
    function setFinishDate($date);
}