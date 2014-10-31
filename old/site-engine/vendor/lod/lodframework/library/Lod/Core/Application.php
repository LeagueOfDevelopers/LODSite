<?php

namespace Lod\Core;

use Lod\Core\Controller\AbstractController;
use Lod\Core\Router\Route;

class Application {

    public static $config = array();
    public static $request_variables = array();

    /** @var $router Route */
    public static $router;

    public static function init($configuration = array()) {
        self::$config = $configuration;
        self::$request_variables = array(
            'request' => $_REQUEST,
            'get' => $_GET,
            'post' => $_POST,
            'cookie' => $_COOKIE,
            'session' => $_SESSION
        );
        return new self();
    }

    function __construct() {}

    public function run() {
        session_start();
        $route = new Route();
        self::$router = $route;

        $controller_class = $route->getControllerName().'\\Controller\\Controller';
        $action_function = $route->getActionName().'Action';
        $params = $route->getParams();

        /** @var $controller AbstractController*/
        $controller = new $controller_class;
        $controller->setParams($params);
        $controller->$action_function();
    }

    public static function disableRequestCache() {
        header("Cache-Control: Cache-Control:no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
    }

    public static function setContentType($type) {
        switch($type) {
            case 'xml':
                header("Content-Type: text/xml; charset=utf-8");
                break;
            case 'json':
                header("Content-Type: application/json; charset=utf-8");
                break;
            case 'html':
                header("Content-Type: text/html; charset=utf-8");
                break;
            default:
                header("Content-Type: text/plain; charset=utf-8");
                break;
        }
    }

    public static function stop($param = null) {
        if ($param) {
            exit($param);
        } else {
            exit();
        }
    }

    public static function debug($object) {
        echo '<hr><pre>';
        if (is_array($object)) {
            print_r($object);
        } else {
            var_dump($object);
        }
        echo '</pre><hr>';
    }

    public static function toRoute($route) {
        header("Location: $route");
    }
}