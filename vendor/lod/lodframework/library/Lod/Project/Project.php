<?php

namespace Lod\Project;

use Lod\Core\Application;
use Lod\Db\LodDatabase;

class Project {
	/**
     * @var $db LodDatabase
    */
    private $db;
    
    /**
     * @var $table_row array
    */

    private $row;
    function __construct(&$db, $row = null) {
        $this->db = $db;
        $this->row = $row;
    }

    public function setTableRow($row) {
        $this->row = $row;

     }

    
    //Получить проект по id
    public function getProjectById($id) {
        if(is_numeric($id)){
            $result = $this->db->query("SELECT * FROM `projects` WHERE `id` = ?i", $id);
        }
        $this->setTableRow($result->num_rows ? $result->fetch_array(MYSQL_ASSOC) : null);
    }

    public function getId() {
        return $this->row ? $this->row['id'] : 0;
    }

    public function getName() {
        return $this->row ? $this->row['name'] : 'лох';
    }

    public function getDescription() {
        return $this->row ? $this->row['description'] : "";
    }

    public function getDescriptionF() {
        $patterns = array(
            '/\[((http|https)\:\/\/(www\.)?[^\r\n\t\f \[\]]*)\]/i',
            '/\s((http|https)\:\/\/(www\.)?[^\r\n\t\f }{]*)\s/i',
            '/\s\-\-\s/i'
        );
        $replacements = array(
            " <div class=\"row\" onclick='Images.resizeFull(this)' style='cursor: pointer; margin: 10px 0'><div class=\"col-xs-6 col-md-6\" style='padding-left: 0;'><a class=\"thumbnail img__cart\" style=\"max-width: 100%; margin-bottom: 0;\"><img src=\"$1\"></a></div></div> ",
            " <a target=\"_blank\" href=\"$1\">$1</a> ",
            " — "
        );
        $text = ' '.($this->row ? $this->row['description'] : "").' ';
        for ($i = 0; $i < count($patterns); $i++) {
            $text = preg_replace($patterns[$i], $replacements[$i], $text);
        }
        return $text;
    }

    public function getDeadLine() {
        return $this->row ? $this->row['deadline'] : 0;
    }

    public function getNameOfOrder() {
        return $this->row ? $this->row['name_of_order'] : 0;
    }

    public function getGitHub() {
        return $this->row ? $this->row['git_hub'] : 0;
    }

    public function getStatus() {
        return $this->row ? $this->row['status'] : 0;
    }

    public function getType() {
        return $this->row ? $this->row['type'] : 0;
    }

    public function getTypeText() {
        $type = $this->row['type'];
        if($type != 0){
                if($type == 1){
                    echo "Верстка/макет сайта";
                }
                if($type == 2){
                    echo "Сайт";
                } 
                if($type == 3){
                    echo "Мобильное приложение Android/iOS/WP";
                } 
                if($type == 4){
                    echo "Desktop-приложения";
                } 
                if($type == 5){
                    echo "Другое";
                }  
        }  
        else {
            echo "Тип не выбран";
        } 
    }

    public function getTypeStatus() {
        $type = $this->row['status'];
                if($type == 3){
                    return "Выполнен";
                }
                if($type == 2){
                    return "В процессе";
                }
                if($type == 1){
                    return "Заморожен";
                }
        } 

}
