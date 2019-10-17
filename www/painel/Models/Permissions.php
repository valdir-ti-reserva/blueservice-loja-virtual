<?php
namespace Models;

use \Core\Model;

class Permissions extends Model {

  public function getPermissionGroupName($id_group){

    $data = $this->simpleGetId('permission_groups', array('name'), array('id'=>$id_group));
    return $data['name'];
  }

	public function getAllGroup() {
    $array = array();

    $sql = "SELECT permission_groups.*,
              (
                select count(users.id) from users where users.id_permission = permission_groups.id
              ) as total_users
              FROM permission_groups";
    $sql = $this->db->query($sql);

    if($sql->rowCount() > 0){
      $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

  	return $array;
  }

  public function getAllItems(){

    return $this->simpleSelect('permission_items');

  }

  public function getItem($id){

    return $this->simpleGetId('permission_items', '*', array('id'=>$id));

  }

  public function editItemName($name, $id){
    $sql = "UPDATE permission_items SET name=:name WHERE id=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":name", $name);
    $sql->bindValue(":id", $id);
    $sql->execute();
  }

  public function addItem($name, $slug){

    $sql = "INSERT INTO permission_items (name, slug) VALUES (:name, :slug)";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":name", $name);
    $sql->bindValue(":slug", $slug);
    $sql->execute();

    return $this->db->lastInsertId();
  }

  public function getPermissions($id_permission){

    $array = array();

    $sql = "SELECT id_permission_item
              FROM permission_links
                WHERE id_permission_group = :id_permission";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id_permission", $id_permission);
    $sql->execute();

    if($sql->rowCount() > 0){

      $data = $sql->fetchAll();
      $ids = array();
      foreach($data as $dataItem){
        $ids[] = $dataItem['id_permission_item'];
      }

      $sql = "SELECT slug
                FROM permission_items
                  WHERE id IN(".implode(',',$ids).")";
      $sql = $this->db->query($sql);

      if($sql->rowCount() > 0){

        $data = $sql->fetchAll();

        foreach($data as $dataItem){
          $array[] = $dataItem['slug'];
        }
      }

    }

    return $array;

  }

  public function addGroup($name){
    $sql = "INSERT INTO permission_groups (name) VALUES (:name)";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":name", $name);
    $sql->execute();

    return $this->db->lastInsertId();
  }

  public function editName($name, $id){
    $sql = "UPDATE permission_groups SET name = :name WHERE id= :id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":name", $name);
    $sql->bindValue(":id", $id);
    $sql->execute();
  }

  public function clearLinks($id){

    $this->deleteFieldName('permission_links', 'id_permission_group', 'id', $id);

  }

  public function linkItemToGroup($id_item, $id_group){
    $sql = "INSERT INTO permission_links (id_permission_group, id_permission_item)
              VALUES (:id_group, :id_item)";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id_item", $id_item);
    $sql->bindValue(":id_group", $id_group);
    $sql->execute();

  }

  public function deleteItem($id){

    $this->deleteByID('permission_items', $id);

  }

  public function deleteItemLinks($id){

    $this->deleteByID('permission_links', $id);

  }

  public function deleteGroup($id){

    $sql = "SELECT id FROM users WHERE id_permission = :id_group";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id_group", $id);
    $sql->execute();

    if($sql->rowCount() === 0){

      $this->deleteFieldName('permission_links', 'id_permission_group', 'id_group', $id);

      $this->deleteFieldName('permission_groups', 'id', 'id_group', $id);

    }

  }

}
