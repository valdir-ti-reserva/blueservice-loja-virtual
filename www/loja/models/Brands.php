<?php

class Brands extends Model
{
  public function getList($filters = array()){

    $array = array();

    $util  = new Util();
    $where = $util->buildWhere($filters);

    $sql = "SELECT *, (select count(*) from products as a where ".implode(' AND ', $where)." AND a.id_brand = brands.id) as total FROM brands";
    $sql = $this->db->prepare($sql);

    $util->bindWhere($filters, $sql);

    $sql->execute();
    if($sql->rowCount() > 0){
      $array = $sql->fetchAll();
    }

    return $array;
  }

  public function getNameById($id){

    $sql = "SELECT name FROM brands WHERE id = :id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();

    if($sql->rowCount() > 0){
      $data = $sql->fetch();
      return $data['name'];
    }else{
      return '';
    }

  }

}
