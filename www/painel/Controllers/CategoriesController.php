<?php
namespace Controllers;

use \Core\Controller;
use \Models\Users;
use \Models\Categories;

class CategoriesController extends Controller {

  private $user;
  private $arrayInfo;
  private $category;

  public function __construct(){

    $this->user = new Users();
    $this->category = new Categories();

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

    $this->arrayInfo['list'] = $this->category->getAll();

		$this->loadTemplate('categories', $this->arrayInfo);
  }

  public function add(){

    $this->arrayInfo['errorItems'] = array();
    $this->arrayInfo['list'] = $this->category->getAll();

    if(isset($_SESSION['formError']) && count($_SESSION['formError']) > 0){
      $this->arrayInfo['errorItems'] = $_SESSION['formError'];
      unset($_SESSION['formError']);
    }

    $this->loadTemplate('categories_add', $this->arrayInfo);

  }

  public function add_action(){
    if(!empty($_POST['name'])){

      $name  = $_POST['name'];
      $sub   = (!empty($_POST['sub']) ? $_POST['sub'] : NULL);
      $this->category->addCategory($name, $sub);

      header("Location: ".BASE_URL."categories");
      exit;

    }else{

      $_SESSION['formError'] = array('name');

      header("Location: ".BASE_URL."categories/add");
      exit;
    }

  }

  public function edit($id){

    if(!empty($id)){

      $this->arrayInfo['errorItems'] = array();

      $this->arrayInfo['list']       = $this->category->getAll();
      $this->arrayInfo['category']   = $this->category->getCategory($id);
      $this->arrayInfo['id']         = $id;

      if(count($this->arrayInfo['category']) > 0){

        if(isset($_SESSION['formError']) && count($_SESSION['formError']) > 0){
          $this->arrayInfo['errorItems'] = $_SESSION['formError'];
          unset($_SESSION['formError']);
        }

        $this->loadTemplate('categories_edit', $this->arrayInfo);

      }else{

        header("Location: ".BASE_URL."categories");
        exit;
      }

    }else{


    }

  }

  public function edit_action($id){
    if(!empty($id) && !empty($_POST['name'])){

      $name  = $_POST['name'];
      $sub   = (!empty($_POST['sub']) ? $_POST['sub'] : NULL);
      $this->category->editCategory($name, $sub, $id);

      header("Location: ".BASE_URL."categories");
      exit;

    }else{

      //Observações
      $_SESSION['formError'] = array('name');

      header("Location: ".BASE_URL."categories/edit/".$id);
      exit;

    }
  }

}
