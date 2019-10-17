<?php

namespace Models;

use \Core\Model;

class Brands extends Model {

  public function getAll(){
    return $this->simpleSelect('brands', 'name');
  }

  public function addBrand($name){

    $this->simpleInsert('brands', 'name', $name);

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

    $data = $this->selectCount('products', 'id_brand', 'id', $id);

    if($data == '0'){
      $this->deleteByID('brands', $id);
    }

  }

}
