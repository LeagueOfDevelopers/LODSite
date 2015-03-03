<?php

namespace Lod\Orders;

interface ProfectInterface() {

	function getAllProject(); // сортированные по статусу
	function getAllProjectByIDUser($id); // 
}

?>