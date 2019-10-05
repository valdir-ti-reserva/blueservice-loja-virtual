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
    $array = array(
      'user'=>$this->user,
      'errorItems'=>array()
    );

    $p = new Permissions();
    $array['permission_items'] = $p->getAllItems();

    if(isset($_SESSION['formError']) && count($_SESSION['formError']) > 0){
      $array['errorItems'] = $_SESSION['formError'];
      unset($_SESSION['formError']);
    }

    $this->loadTemplate('permissions_add', $array);
  }

  public function add_action(){

    if(!empty($_POST['name'])){

      $name = $_POST['name'];
      $p    = new Permissions();
      $id   = $p->addGroup($name);

      if(isset($_POST['items']) && count($_POST['items']) > 0){

        $items = $_POST['items'];

        foreach($items as $item){
          $p->linkItemToGroup($item, $id);
        }
      }

      header("Location: ".BASE_URL."permissions");
      exit;

    }else{

      //Observações
      $_SESSION['formError'] = array('name');

      header("Location: ".BASE_URL."permissions/add");
      exit;
    }

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
