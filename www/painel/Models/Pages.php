<?php
namespace Models;

use \Core\Model;

class Pages extends Model {

	public function getAll():array {
    $array = array();

    $sql = "SELECT id, title FROM pages";
    $sql = $this->db->query($sql);

    if($sql->rowCount() > 0 ){
      $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

		return $array;
	}

}
