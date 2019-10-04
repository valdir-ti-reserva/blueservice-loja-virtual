<?php
namespace Controllers;

use \Core\Controller;
use \Models\Users;
use \Models\Permissions;

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
      'list'=>array()
    );

    $p = new Permissions();
    $array['list'] = $p->getAllGroup();


    $this->loadTemplate('permissions', $array);

  }

  public function add(){

  }

  public function edit($id){

  }

  public function del($id){

    $p = new Permissions();

    $p->deleteGroup($id);


    header("Location: ".BASE_URL."permissions");
    exit;

  }

}
