<?php

//Classe com funcionalidades padrões
class Util extends Model{

  public function buildWhere($filters){

    $where = array('1=1');

    if(!empty($filters['category'])){
      $where[] = "id_category = :id_category";
    }

    if(!empty($filters['brand'])){

      $where[] = " id_brand IN('".implode("', '", $filters['brand'])."')";

    }

    if(!empty($filters['star'])){

      $where[] = " rating IN('".implode("', '", $filters['star'])."')";

    }

    if(!empty($filters['sale'])){

      $where[] = " sale  = '1'";

    }

    if(!empty($filters['options'])){

      $where[] = " id IN (select id_product from products_options where products_options.p_value IN('".implode("', '", $filters['options'])."'))";

    }

    return $where;

  }

  public function bindWhere($filters, &$sql){

    if(!empty($filters['category'])){
      $sql->bindValue(":id_category", $filters['category']);
    }

  }

}
