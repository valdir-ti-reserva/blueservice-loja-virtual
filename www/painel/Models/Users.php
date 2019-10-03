<?php
namespace Models;

use \Core\Model;
use \Models\Permissions;

class Users extends Model {

  private $uid;
  private $permissions;

	public function isLogged() {

    if(!empty($_SESSION['token'])){
      $token = $_SESSION['token'];
    }

    $sql = "SELECT id, id_permission FROM users WHERE token=:token";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":token", $token);
    $sql->execute();

    if($sql->rowCount() > 0){
      $p = new Permissions();

      $data      = $sql->fetch();
      $this->uid = $data['id'];

      $this->permissions = $p->getPermissions($data['id_permission']);

      return true;

    }

    return false;

  }

  public function validateLogin($email, $pass){

    $sql = "SELECT id FROM users WHERE email = :email AND password = :password AND admin = 1";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":email", $email);
    $sql->bindValue(":password", md5($pass));
    $sql->execute();

    if($sql->rowCount() > 0){
      $data  = $sql->fetch();

      $token = md5(time().rand(0,999).$data['id'].time());

      $sql = "UPDATE users SET token = :token WHERE id = :id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(":token", $token);
      $sql->bindValue(":id", $data['id']);
      $sql->execute();

      $_SESSION['token'] = $token;

      return true;

    }


    return false;

  }

  public function getId(){
    return $this->uid;
  }

}
