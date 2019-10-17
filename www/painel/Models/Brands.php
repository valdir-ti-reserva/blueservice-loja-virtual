<?php

namespace Models;

use \Core\Model;

class Brands extends Model {

  public function getAll(){
    return $this->simpleSelect('brands', 'name');
  }

  public function addBrand($name){

    $sql = "INSERT INTO brands SET name=:name";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":name", $name);
    $sql->execute();

  }

  public function getBrand($id):array{

    return $this->simpleGetId('brands', '*', array('id'=>$id));
  }

  public function editName($name, $id){

    $sql = "UPDATE brands SET name=:name WHERE id=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id",$id);
    $sql->bindValue(":name",$name);
    $sql->execute();

  }

  public function delete($id){

    $sql = "SELECT count(*) as c FROM products WHERE id_brand = :id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();
    $data = $sql->fetch();

    if($data['c'] == '0'){
      $this->deleteByID('brands', $id);
    }

  }

}
