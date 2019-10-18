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
  public function simpleSelect($table, $orderField = 'id', $order = 'ASC'):array{
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
  public function simpleSelectFields($table, $fields = array(), $order = 'ASC'):array{
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
  public function simpleGetId($table, $fields = array(), $find = array()):array{
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

  public function fullSelect($field, $table, $fieldWhere, $fieldBind, $value):array{
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
  public function selectCount($table, $field, $fieldBind, $value){
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
  public function deleteByID($table, $id):void{
    $sql = "DELETE FROM ".$table." WHERE id=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();
  }

  /*
  * Delete with field name
  */
  public function deleteFieldName($table, $field, $fieldBind, $value):void{
    $sql = "DELETE FROM ".$table." WHERE ".$field." = :".$fieldBind."";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":".$fieldBind, $value);
    $sql->execute();
  }

  /*
  * To insert a simple field
  */
  public function simpleInsert($table, $field, $value):void{
    $sql = "INSERT INTO ".$table." SET ".$field."=:".$field."";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":".$field, $value);
    $sql->execute();
  }

  /*
  * To insert a simple field and return last ID
  */
  public function simpleInsertLastId($table, $field, $value):int{
    $sql = "INSERT INTO ".$table." SET ".$field."=:".$field."";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":".$field, $value);
    $sql->execute();

    return $this->db->lastInsertId();
  }

  /*
  * To update a simple field
  */
  public function updateSimpleFieldByID($table, $field, $fieldBind, $id, $value):void{
    $sql = "UPDATE ".$table." SET ".$field."=:".$fieldBind." WHERE id=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id",$id);
    $sql->bindValue(":".$fieldBind,$value);
    $sql->execute();
  }
}
