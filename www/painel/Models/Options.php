<?php

namespace Models;

use \Core\Model;

class Options extends Model {

	public function getAll($checkHasProduct = false):array {
    $array = array();

    if($checkHasProduct){
      $sql = "SELECT *,
                (select count(*) from products_options where products_options.id = options.id) as product_count
                  FROM options";
    }else{
      $sql = "SELECT * FROM options";
    }

    $sql = $this->db->query($sql);

    if($sql->rowCount() > 0){
      $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

		return $array;
  }

  public function addOption($name){

    $this->simpleInsert('options', 'name', $name);

  }

  public function getOption($id):array{

    return $this->simpleGetId('options', '*', array('id'=>$id));

  }

  public function editName($name, $id){

    $sql = "UPDATE options SET name=:name WHERE id=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id",$id);
    $sql->bindValue(":name",$name);
    $sql->execute();

  }

  public function delete($id){

    $data = $this->selectCount('products_options', 'id_option', 'id', $id);

    if($data == '0'){

      $this->deleteByID('options', $id);

    }
  }

}
