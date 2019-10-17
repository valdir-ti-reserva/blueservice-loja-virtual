<?php
namespace Models;

use \Core\Model;

class Permissions extends Model {

  public function getPermissionGroupName($id_group){

    $sql = "SELECT name FROM permission_groups WHERE id = :id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id_group);
    $sql->execute();

    if($sql->rowCount() > 0){
      $data = $sql->fetch();
      return $data['name'];
    }
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
    $array = array();

    $sql = "SELECT * FROM permission_items";
    $sql = $this->db->query($sql);

    if($sql->rowCount() > 0){
      $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    return $array;
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
    $sql = "DELETE FROM permission_links WHERE id_permission_group = :id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();
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

    $sql = "DELETE FROM permission_items WHERE id=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();
  }

  public function deleteItemLinks($id){

    $sql = "DELETE FROM permission_links WHERE id_permission_item=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();
  }

  public function deleteGroup($id){

    $sql = "SELECT id FROM users WHERE id_permission = :id_group";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id_group", $id);
    $sql->execute();

    if($sql->rowCount() === 0){

      $sql = "DELETE FROM permission_links WHERE id_permission_group = :id_group";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(":id_group", $id);
      $sql->execute();

      $sql = "DELETE FROM permission_groups WHERE id = :id_group";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(":id_group", $id);
      $sql->execute();

    }

  }

}
