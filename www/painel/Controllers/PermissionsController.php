<?php
namespace Controllers;

use \Core\Controller;
use \Models\Users;

class PermissionsController extends Controller {

  private $user;

  public function __construct(){

    $this->user = new Users();

    if(!$this->user->isLogged()){
      header("Location: ".BASE_URL."login");
      exit;
    }

    if(!$this->user->hasPermission('permissions_view')){

      header("Location: ".BASE_URL);
      exit;
    }
  }

	public function index() {

    $array = array(
      'user'=>$this->user,
    );

    $this->loadTemplate('permissions', $array);

	}

}
