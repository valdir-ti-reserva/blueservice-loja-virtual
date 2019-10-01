<?php
namespace Controllers;

use \Core\Controller;

class LoginController extends Controller {

	public function index() {
    $array = array();

    $this->loadView('login', array());
  }

  public function index_active(){

    $email = $_POST['email'];
    $pass  = $_POST['password'];










  }


}
