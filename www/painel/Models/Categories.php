<?php
namespace Models;

use \Core\Model;

class Categories extends Model {

	public function getAll():array {
    $array = array();

    $sql = "SELECT * FROM categories ORDER BY sub DESC";
    $sql = $this->db->query($sql);

    if($sql->rowCount() > 0){

      $data = $sql->fetchAll(\PDO::FETCH_ASSOC);

      //Organizando o array
      foreach($data as $item){
        $item['subs'] = array();
        $array[$item['id']] = $item;
      }

      while( $this->stillNeed($array) ){
        $this->organizeCategory($array);

      }

    }

		return $array;
  }

  private function stillNeed($array):bool{
    foreach($array as $item){
      if(!empty($item['sub'])){
        return true;
      }
    }
    return false;
  }

  private function organizeCategory(&$array){
    foreach($array as $id => $item){
      if(!empty($item['sub'])){
        $array[$item['sub']]['subs'][$item['id']] = $item;
        unset($array[$id]);
        break;
      }
    }
  }

  public function addCategory($name, $sub){

    $sql = "INSERT INTO categories SET name=:name, sub=:sub";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":name", $name);
    $sql->bindValue(":sub", $sub);
    $sql->execute();

  }

  public function getCategory($id):array{
    $array = array();
    $sql = "SELECT * FROM categories WHERE id=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();

    if($sql->rowCount() > 0){
      $array = $sql->fetch(\PDO::FETCH_ASSOC);
    }

    return $array;
  }

  public function editCategory($name, $sub, $id){

    $sql = "UPDATE categories SET name=:name, sub=:sub WHERE id=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":name", $name);
    $sql->bindValue(":sub", $sub);
    $sql->bindValue(":id", $id);
    $sql->execute();
  }

}
