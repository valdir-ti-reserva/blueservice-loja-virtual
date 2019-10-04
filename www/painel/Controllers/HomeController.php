<?php
namespace Controllers;

use \Core\Controller;
use \Models\Users;

class HomeController extends Controller {

  private $user;

  public function __construct(){

    //$_SESSION['token'] = NULL;
    $this->user = new Users();

    if(!$this->user->isLogged()){
      header("Location: ".BASE_URL."login");
      exit;
    }
  }

	public function index() {
    $array = array(
      'user'=>$this->user
    );


		$this->loadTemplate('home', $array);
	}

}
