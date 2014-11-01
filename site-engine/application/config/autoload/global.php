<?php

namespace Autoloader;

class Autoload {

    public static $loader;
    public $configuration;

    public static function init() {
        if (!self::$loader) {
            self::$loader = new self();
        }
        return self::$loader;
    }

    public function __construct() {
        $this->configuration = require Q_PATH . '/application/config/application.config.php';
        spl_autoload_register(array(
            $this, 'libraryAutoload'
        ));
        spl_autoload_register(array(
            $this, 'moduleAutoload'
        ));
    }

    public function libraryAutoload($class) {
        $class_path = '/'.str_replace('\\', '/', $class);
        $vendor_options = $this->configuration['vendor_options'];
        $core_path = $vendor_options['vendor_path'].$vendor_options['projects']['lod']['library_path'].$class_path;
        if (file_exists(Q_PATH.$core_path.'.php')) {
            require_once Q_PATH.$core_path.'.php';
        }
    }

    public function moduleAutoload($class) {
        $class_path = '/'.str_replace('\\', '/', $class);
        $module_options = $this->configuration['module_options'];
        $controller_path = $module_options['module_path'].$class_path;
        if (file_exists(Q_PATH.$controller_path.'.php')) {
            require_once Q_PATH.$controller_path.'.php';
        }
    }
}