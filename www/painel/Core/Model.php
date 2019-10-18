<?php
namespace Core;

class Model {

	protected $db;

	public function __construct() {
		global $db;
		$this->db = $db;
  }

  /*
  * Simple Select
  */
  protected function simpleSelect($table, $orderField = 'id', $order = 'ASC'):array{
    $array = array();
    $sql   = "SELECT * FROM ".$table." ORDER BY ".$orderField." ".$order;
    $sql   = $this->db->query($sql);
    if($sql->rowCount() > 0){
      $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
    }
		return $array;
  }

  /*
  * Simple Select with fields to return
  */
  protected function simpleSelectFields($table, $fields = array(), $order = 'ASC'):array{
    $array = array();
    $sql   = "SELECT ".implode(',',$fields)." FROM ".$table." ORDER BY id ".$order;
    $sql   = $this->db->query($sql);
    if($sql->rowCount() > 0 ){
      $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
    }
		return $array;
  }

  /*
  * Simple Get with ID and fields
  */
  protected function simpleGetId($table, $fields = array(), $find = array()):array{
    $array = array();
    $campo = '';
    $valor = '';
    foreach($find as $k=>$v){
      $campo .= $k;
      $valor .=$v;
    }
    $sql = "SELECT ".($fields != '*' ? implode(',', $fields) : '*')." FROM ".$table." WHERE ".$campo."=:".$campo."";
    $sql = $this->db->prepare($sql);
    $sql->bindValue($campo, $valor);
    $sql->execute();

    if($sql->rowCount() > 0){
      $array = $sql->fetch(\PDO::FETCH_ASSOC);
    }

    return $array;
  }

  protected function fullSelect($field, $table, $fieldWhere, $fieldBind, $value):array{
    $array = array();
    $sql = "SELECT ".$field." FROM ".$table." WHERE ".$fieldWhere." = :".$fieldBind;
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":".$fieldBind, $value);
    $sql->execute();

    if($sql->rowCount() > 0){
      $array = $sql->fetch(\PDO::FETCH_ASSOC);
    }

    return $array;
  }

  /*
  * Select Count with params
  */
  protected function selectCount($table, $field, $fieldBind, $value){
    $sql = "SELECT count(*) as c FROM ".$table." WHERE ".$field." = :".$fieldBind."";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":".$fieldBind, $value);
    $sql->execute();
    $data = $sql->fetch();
    return $data['c'];
  }

  /*
  * Delete By ID
  */
  protected function deleteByID($table, $id):void{
    $sql = "DELETE FROM ".$table." WHERE id=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();
  }

  /*
  * Delete with field name
  */
  protected function deleteFieldName($table, $field, $fieldBind, $value):void{
    $sql = "DELETE FROM ".$table." WHERE ".$field." = :".$fieldBind."";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":".$fieldBind, $value);
    $sql->execute();
  }

  /*
  * Insert multiple fields
  */
  protected function complexInsert($table, $fields = array()){

    $keys = array_keys($fields);
    $bind = array();
    foreach($fields as $k=>$v){
      $bind[] = ':'.$k;
    }
    $sql = "INSERT INTO ".$table." (".implode(',',$keys).") VALUES (".implode(',', $bind).")";
    $sql = $this->db->prepare($sql);
    foreach($fields as $k=>$field){
      $sql->bindValue(":".$k, $field);
    }
    $sql->execute();
  }

  /*
  * To insert a simple field and return last ID
  */
  protected function simpleInsertLastId($table, $field, $value):int{
    $sql = "INSERT INTO ".$table." SET ".$field."=:".$field."";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":".$field, $value);
    $sql->execute();

    return $this->db->lastInsertId();
  }

  /*
  * To update a simple field
  */
  protected function updateSimpleFieldByID($table, $field, $fieldBind, $id, $value):void{
    $sql = "UPDATE ".$table." SET ".$field."=:".$fieldBind." WHERE id=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id",$id);
    $sql->bindValue(":".$fieldBind,$value);
    $sql->execute();
  }
}
