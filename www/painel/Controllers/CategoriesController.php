<?php
namespace Controllers;

use \Core\Controller;
use \Models\Users;

class CategoriesController extends Controller {

  private $user;
  private $arrayInfo;

  public function __construct(){

    $this->user = new Users();

    if(!$this->user->isLogged()){
      header("Location: ".BASE_URL."login");
      exit;
    }

    $this->arrayInfo = array(
      'user'=>$this->user,
      'menuActive'=>'categories'
    );
  }

	public function index() {

    $this->arrayInfo['list'] = array();

		$this->loadTemplate('categories', $this->arrayInfo);
	}

}
