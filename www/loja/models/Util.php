<?php

//Classe com funcionalidades padrões
class Util extends Model{

  public function buildWhere($filters){

    $where = array('1=1');

    if(!empty($filters['category'])){
      $where[] = "id_category = :id_category";
    }

    return $where;

  }

  public function bindWhere($filters, &$sql){

    if(!empty($filters['category'])){
      $sql->bindValue(":id_category", $filters['category']);
    }

  }

}
