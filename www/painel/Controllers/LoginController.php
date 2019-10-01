<?php
namespace Controllers;

use \Core\Controller;
use \Models\Users;

class LoginController extends Controller {

	public function index() {
    $array = array();

    $this->loadView('login', array());
  }

  public function index_active(){

    if(!empty($_POST['email']) && !empty($_POST['password'])){

      $email = $_POST['email'];
      $pass  = $_POST['password'];

      $u     = new Users();
      if($u->validateLogin($email, $pass)){



        header("Location: ".BASE_URL);
        exit;
      }

    }

    header("Location: ".BASE_URL."login");
    exit;


  }


}
