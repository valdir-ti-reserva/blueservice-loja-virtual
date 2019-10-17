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

    return $this->simpleGetId('categories', '*', array('id'=>$id));

  }

  public function editCategory($name, $sub, $id){

    $sql = "UPDATE categories SET name=:name, sub=:sub WHERE id=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":name", $name);
    $sql->bindValue(":sub", $sub);
    $sql->bindValue(":id", $id);
    $sql->execute();
  }

  //Ler as categorias e verificar se há sub itens na mesma
  public function scanCategories($id, $cats = array()):array{

    if(!in_array($id, $cats)){
      $cats[] = $id;
    }

    $sql = "SELECT id FROM categories WHERE sub=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();

    if($sql->rowCount() > 0){
      $data = $sql->fetchAll();

      foreach($data as $item){
        if(!in_array($item['id'], $cats)){
          $cats[] = $item['id'];
        }

        $cats = $this->scanCategories($item['id'], $cats);

      }
    }

    return $cats;
  }


  //Verificar se não há produtos atrelados a categoria
  public function hasProduct($cats):bool{

    $sql  = "SELECT COUNT(*) AS c FROM products WHERE id IN (".implode(',',$cats).")";
    $sql  = $this->db->query($sql);

    $data = $sql->fetch();

    if(intval($data['c']) > 0){
      return true;
    }

    return false;
  }

  //Deletando várias categorias
  public function deleteCategories($cats){
    $sql = "DELETE FROM categories WHERE id IN (".implode(',', $cats).")";
    $sql = $this->db->query($sql);
  }

}
