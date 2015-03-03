<?php

namespace Lod\Project;
use Lod\Db\LodDatabase;
use Lod\User\User;

class Projects {
	/**
     * @var $db LodDatabase
    */
    private $db;

    function __construct(&$db) {
        $this->db = $db;
    }
    //Вывод всех проектов
    public function getAllProjects() {
    	$result = $this->db->query("SELECT * FROM `projects` ORDER BY `id` DESC");
        $projects_list = array();
    	while($row = $result->fetch_array(MYSQL_ASSOC)) {
    			$project_item = new Project($this->db, $row);
    			array_push($projects_list,$project_item);
    	}
    	return $projects_list; 
    }

    public function getAllProjectsByUser($id) {
        $result = $this->db->query("SELECT projects.*
FROM `usersofproject` 
LEFT JOIN projects ON projects.id = usersofproject.id_project
WHERE usersofproject.id_user = ?i 
ORDER BY projects.`id` DESC",
$id);
        $projects_list = array();
        while($row = $result->fetch_array(MYSQL_ASSOC)) {
                $project_item = new Project($this->db, $row);
                array_push($projects_list,$project_item);
        }
        return $projects_list; 
    }

    //Вывод новых проектов без команды
    public function getAllNewProject() {
    	$result = $this->db->query("SELECT * FROM 'projects' WHERE 'status' = '-1' ORDER BY 'id' DESC");
    	$projects_list = array();
    	while($row = $result->fetch_array(MYSQL_ASSOC)) {
    			$project_item = new Project($this->db, $row);
    			array_push($projects_list,$project_item);
    	}
    	return $projects_list;
    }

    public function createProject($data, $by = null, $id_project = null) {
        echo "1";
        $this->db->query(
            "INSERT INTO `projects` (`id`, `name`, `description`, `deadline`, `name_of_order`, `git_hub`, `status`, `type`)
            VALUES (?i, ?s, ?s, ?s, ?s, ?s, ?s, ?s)", 0 , $data['name'], $data['description'], $data['deadline'], $data['name_of_order'], $data['git_hub'], $data['status'], $data['type']);
        $last_id = $this->db->getDriver()->insert_id;
        if(!empty($data['checkboxuser'])){
            $k = 0;
        foreach($data['checkboxuser'] as $check){
            
            $state = "statusonproject" . $check;
                $this->db->query("INSERT INTO `usersofproject` (`id_project`, `id_user`, `status`) VALUES (?i, ?i, ?s)", $last_id, $check, $data[$state]);
                $this->db->query("UPDATE `users` SET `have_projects` = 1 WHERE `id` = ?i", $check);
                $k++;
            }
        }
        if($by == "order")
        {
        $this->db->query("UPDATE `orders` SET `status` = 1 WHERE `id` = ?i", $id_project);
        }

        $this->db->query("COMMIT");
    }

    public function editProject($data, $id_project) {
        $this->db->query(
            "UPDATE `projects` SET
            `name` = ?s, `description` = ?s, `deadline` = ?s, `name_of_order`=?s, `git_hub` = ?s, `status` = ?s, `type` = ?s
             WHERE `id` = ?i", $data['name'], $data['description'], $data['deadline'], $data['name_of_order'], $data['git_hub'], $data['status'], $data['type'], $id_project);
        if(!empty($data['checkboxuser'])){
        foreach($data['checkboxuser'] as $check){
            $state = "statusonproject" . $check;
                $this->db->query("INSERT INTO `usersofproject` (`id_project`, `id_user`, `status`) VALUES (?i, ?i, ?s)", $id_project, $check, $data[$state]);
                $this->db->query("UPDATE `users` SET `have_projects` = 1 WHERE `id` = ?i", $check);
            }
        }

        $this->db->query("COMMIT");
    }

    public function getUsersOnProject($id) {
        if(is_numeric($id)){
            $temp = $this->db->query("SELECT `id_user` FROM `usersofproject` WHERE `id_project` = ?i", $id);
            $listOfUsers = array();
            while($row = $temp->fetch_array(MYSQL_ASSOC)['id_user']) {
            $result = $this->db->query("SELECT `first_name` , `second_name`, `id` FROM `users` WHERE `id` = ?i ", $row);
            $res = $result->fetch_array(MYSQL_ASSOC);
            $user = new User($this->db, $res);
            array_push($listOfUsers, $user);
            }
        }
        
            return $listOfUsers;

        }
    }

