<?php
namespace Models;

use \Core\Model;

class Pages extends Model {

	public function getAll():array {
    return $this->simpleSelectFields('pages', ['id', 'title']);
  }

  public function getPage($id):array{

    return $this->simpleGetId('pages', '*', array('id'=>$id));

  }

  public function add($title, $body){
    $sql = "INSERT INTO pages SET title=:title, body=:body";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":title", $title);
    $sql->bindValue(":body", $body);
    $sql->execute();
  }

  public function edit($id, $title, $body){
    $sql = "UPDATE pages SET title=:title, body=:body WHERE id=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->bindValue(":title", $title);
    $sql->bindValue(":body", $body);
    $sql->execute();
  }

  public function del($id){

    $this->deleteByID('pages', $id);

  }

}
