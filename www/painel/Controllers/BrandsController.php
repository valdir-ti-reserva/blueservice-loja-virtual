<?php
namespace Controllers;

use \Core\Controller;
use \Models\Users;
use \Models\Brands;

class BrandsController extends Controller {

  private $user;
  private $arrayInfo;
  private $brand;

  public function __construct(){

    $this->user  = new Users();
    $this->brand = new Brands();

    if(!$this->user->isLogged()){
      header("Location: ".BASE_URL."login");
      exit;
    }

    $this->arrayInfo = array(
      'user'=>$this->user,
      'menuActive'=>'brands'
    );
  }

	public function index() {

    $this->arrayInfo['list'] = $this->brand->getAll();

		$this->loadTemplate('brands', $this->arrayInfo);
  }

  public function add(){

    $this->arrayInfo['errorItems'] = array();

    if(isset($_SESSION['formError']) && count($_SESSION['formError']) > 0){
      $this->arrayInfo['errorItems'] = $_SESSION['formError'];
      unset($_SESSION['formError']);
    }

    $this->loadTemplate('brands_add', $this->arrayInfo);

  }

  public function add_action(){
    if(!empty($_POST['name'])){

      $name  = $_POST['name'];
      $this->brand->addBrand($name);

      header("Location: ".BASE_URL."brands");
      exit;

    }else{

      $_SESSION['formError'] = array('name');

      header("Location: ".BASE_URL."brands/add");
      exit;
    }
  }

  public function edit($id){

    if(!empty($id)){
      $this->arrayInfo['errorItems'] = array();

      $this->arrayInfo['brand'] = $this->brand->getBrand($id);

      if(isset($_SESSION['formError']) && count($_SESSION['formError']) > 0){
        $this->arrayInfo['errorItems'] = $_SESSION['formError'];
        unset($_SESSION['formError']);
      }

      $this->loadTemplate('brands_edit', $this->arrayInfo);

    }else{

      header("Location: ".BASE_URL."brands");
      exit;

    }
  }

  public function edit_action($id){
    if(!empty($id) && !empty($_POST['name'])){

      $name  = $_POST['name'];
      $this->brand->editName($name, $id);

      header("Location: ".BASE_URL."brands");
      exit;

    }else{

      //Observações
      $_SESSION['formError'] = array('name');

      header("Location: ".BASE_URL."brands/edit/".$id);
      exit;

    }
  }

  public function del($id){

    if(!empty($id)){
      $this->brand->delete($id);
    }

    header("Location: ".BASE_URL."brands");
    exit;

  }

}
