<?php

namespace Models;

use \Core\Model;

class Brands extends Model {

	public function getAll():array {
    $array = array();

    $sql = "SELECT * FROM brands";
    $sql = $this->db->query($sql);

    if($sql->rowCount() > 0){
      $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

		return $array;
  }

  public function addBrand($name){

    $sql = "INSERT INTO brands SET name=:name";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":name", $name);
    $sql->execute();

  }

  public function getBrand($id):array{

    $array = array();
    $sql = "SELECT * FROM brands WHERE id=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();

    if($sql->rowCount() > 0){
      $array = $sql->fetch(\PDO::FETCH_ASSOC);
    }

    return $array;

  }

  public function editName($name, $id){

    $sql = "UPDATE brands SET name=:name WHERE id=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id",$id);
    $sql->bindValue(":name",$name);
    $sql->execute();

  }

  public function delete($id){

    $sql = "DELETE FROM brands WHERE id=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();

  }

}
