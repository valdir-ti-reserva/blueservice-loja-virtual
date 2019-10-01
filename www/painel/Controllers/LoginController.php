<?php
namespace Controllers;

use \Core\Controller;
use \Models\Users;

class LoginController extends Controller {

	public function index() {
    $array = array(
      'error' => ''
    );

    if(!empty($_SESSION['errorMsg'])){
      $array['error'] = $_SESSION['errorMsg'];
      $_SESSION['errorMsg'] = '';
    }

    $this->loadView('login', $array);
  }

  public function index_active(){

    if(!empty($_POST['email']) && !empty($_POST['password'])){

      $email = $_POST['email'];
      $pass  = $_POST['password'];

      $u     = new Users();
      if($u->validateLogin($email, $pass)){
        header("Location: ".BASE_URL);
        exit;
      }else{
        $_SESSION['errorMsg'] = 'Usuários e/ou senha inválidos!';
      }

    }else{

      $_SESSION['errorMsg'] = 'Preencha os campos abaixo!';

    }

    header("Location: ".BASE_URL."login");
    exit;

  }

}
