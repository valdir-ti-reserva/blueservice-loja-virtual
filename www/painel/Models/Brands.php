<?php

namespace Models;

use \Core\Model;

class Brands extends Model {

  public function getAll(){
    return $this->simpleSelect('brands', 'name');
  }

  public function addBrand($name){
    $this->complexInsert('brands', $fields = array('name'=>$name));
  }

  public function getBrand($id):array{
    return $this->simpleGetId('brands', '*', array('id'=>$id));
  }

  public function editName($name, $id){
    $this->updateSimpleFieldByID('brands', 'name', 'name', $id, $name);
  }

  public function delete($id){
    $data = $this->selectCount('products', 'id_brand', 'id', $id);
    if($data == '0'){
      $this->deleteByID('brands', $id);
    }
  }

}
