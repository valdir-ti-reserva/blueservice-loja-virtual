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

  public function items(){
    $array = array(
      'user'=>$this->user,
      'list'=>array()
    );

    $p = new Permissions();
    $array['list'] = $p->getAllItems();

    $this->loadTemplate('permissions_items', $array);
  }

  public function items_add(){
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

      $this->loadTemplate('permissions_items_add', $array);
  }

  public function add_items_action(){

    if(!empty($_POST['name']) && !empty($_POST['slug'])){

      $name = $_POST['name'];
      $slug = $_POST['slug'];
      $p    = new Permissions();
      $p->addItem($name, $slug);

      header("Location: ".BASE_URL."permissions/items");
      exit;

    }else{

      $_SESSION['formError'] = array('name', 'slug');

      header("Location: ".BASE_URL."permissions/items_add");
      exit;
    }
  }

  public function items_edit($id){

    if(!empty($id)){

      $array = array(
        'user'=>$this->user,
        'errorItems'=>array()
      );

      $p = new Permissions();
      $array['permission_item'] = $p->getItem($id);

      if(isset($_SESSION['formError']) && count($_SESSION['formError']) > 0){
        $array['errorItems'] = $_SESSION['formError'];
        unset($_SESSION['formError']);
      }

      $this->loadTemplate('permissions_item_edit', $array);

    }else{

      header("Location: ".BASE_URL."permissions/items");
      exit;
    }
  }

  public function edit_items_action($id){
    if(!empty($id)){

      $name = $_POST['name'];
      $p    = new Permissions();
      $p->editItemName($name, $id);

      header("Location: ".BASE_URL."permissions/items");
      exit;

    }else{

      //Observações
      $_SESSION['formError'] = array('name');

      header("Location: ".BASE_URL."permissions/items".$id);
      exit;

    }
  }

  public function items_del($id){

    $p = new Permissions();
    $p->deleteItem($id);
    $p->deleteItemLinks($id);

    header("Location: ".BASE_URL."permissions");
    exit;

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
    if(!empty($id)){

      $array = array(
        'user'=>$this->user,
        'errorItems'=>array()
      );

      $p = new Permissions();
      $array['permission_items']       = $p->getAllItems();
      $array['permission_id']          = $id;
      $array['permission_group_name']  = $p->getPermissionGroupName($id);
      $array['permission_group_slugs'] = $p->getPermissions($id);

      if(isset($_SESSION['formError']) && count($_SESSION['formError']) > 0){
        $array['errorItems'] = $_SESSION['formError'];
        unset($_SESSION['formError']);
      }

      $this->loadTemplate('permissions_edit', $array);

    }else{

      header("Location: ".BASE_URL."permissions");
      exit;
    }

  }

  public function edit_action($id){

    if(!empty($id)){

      if(!empty($_POST['name'])){

        $name = $_POST['name'];
        $p    = new Permissions();

        $p->editName($name, $id);
        $p->clearLinks($id);

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

        header("Location: ".BASE_URL."permissions/edit/".$id);
        exit;
      }

    }else{
      header("Location: ".BASE_URL."permissions");
      exit;
    }

  }

  public function del($id){

    $p = new Permissions();

    $p->deleteGroup($id);

    header("Location: ".BASE_URL."permissions");
    exit;

  }

}
