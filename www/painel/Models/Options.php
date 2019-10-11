<?php

namespace Models;

use \Core\Model;

class Options extends Model {

	public function getAll():array {
    $array = array();

    $sql = "SELECT * FROM options";
    $sql = $this->db->query($sql);

    if($sql->rowCount() > 0){
      $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

		return $array;
  }

  public function addOption($name){

    $sql = "INSERT INTO options SET name=:name";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":name", $name);
    $sql->execute();

  }

  public function getOption($id):array{

    $array = array();
    $sql = "SELECT * FROM options WHERE id=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();

    if($sql->rowCount() > 0){
      $array = $sql->fetch(\PDO::FETCH_ASSOC);
    }

    return $array;

  }

  public function editName($name, $id){

    $sql = "UPDATE options SET name=:name WHERE id=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id",$id);
    $sql->bindValue(":name",$name);
    $sql->execute();

  }

  public function delete($id){

    $sql = "DELETE FROM options WHERE id=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();

  }

}
