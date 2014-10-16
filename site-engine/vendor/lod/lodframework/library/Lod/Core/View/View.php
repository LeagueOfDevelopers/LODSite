<?php

namespace Lod\Core\View;

class View extends AbstractView {

    function __construct($module_name) {
        parent::__construct($module_name);
    }

    public function includePage() {
        $this->includeView('head');
        $this->includeModuleView($this->view);
    }

    public function generate() {
        $this->includeFile($this->common_view_path.'/common.tpl.php');
    }

    public function setTitle($title) {
        $this->general_includes['title'] = $title;
    }
}