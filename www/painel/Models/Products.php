<?php

namespace Models;

use \Core\Model;
use \Models\Categories;
use \Models\Brands;

class Products extends Model {

	public function getAll():array {
    $array = array();

    $sql = "SELECT id_category, id_brand, name, stock, price_from, price FROM products";
    $sql = $this->db->query($sql);

    if($sql->rowCount() > 0){
      $c = new Categories();
      $b = new Brands();

      $array = $sql->fetchAll(\PDO::FETCH_ASSOC);

      foreach($array as $k => $item){
        $brandInfo = $b->getBrand($item['id_brand']);
        $catInfo = $c->getCategory($item['id_category']);
        $array[$k]['name_brand']    = $brandInfo['name'];
        $array[$k]['name_category'] = $catInfo['name'];
      }
    }

		return $array;
  }

  // public function addBrand($name){

  //   $sql = "INSERT INTO brands SET name=:name";
  //   $sql = $this->db->prepare($sql);
  //   $sql->bindValue(":name", $name);
  //   $sql->execute();

  // }

  // public function getBrand($id):array{

  //   $array = array();
  //   $sql = "SELECT * FROM brands WHERE id=:id";
  //   $sql = $this->db->prepare($sql);
  //   $sql->bindValue(":id", $id);
  //   $sql->execute();

  //   if($sql->rowCount() > 0){
  //     $array = $sql->fetch(\PDO::FETCH_ASSOC);
  //   }

  //   return $array;

  // }

  // public function editName($name, $id){

  //   $sql = "UPDATE brands SET name=:name WHERE id=:id";
  //   $sql = $this->db->prepare($sql);
  //   $sql->bindValue(":id",$id);
  //   $sql->bindValue(":name",$name);
  //   $sql->execute();

  // }

  // public function delete($id){

  //   $sql = "DELETE FROM brands WHERE id=:id";
  //   $sql = $this->db->prepare($sql);
  //   $sql->bindValue(":id", $id);
  //   $sql->execute();

  // }

}
