<?php
namespace Controllers;

use \Core\Controller;
use \Models\Users;
use \Models\Options;

class OptionsController extends Controller {

  private $user;
  private $arrayInfo;
  private $option;

  public function __construct(){

    $this->user  = new Users();
    $this->option = new Options();

    if(!$this->user->isLogged()){
      header("Location: ".BASE_URL."login");
      exit;
    }

    if(!$this->user->hasPermission('brands_view')){
      header("Location: ".BASE_URL);
      exit;
    }

    $this->arrayInfo = array(
      'user'=>$this->user,
      'menuActive'=>'options'
    );
  }

	public function index() {

    $this->arrayInfo['list'] = $this->option->getAll();

		$this->loadTemplate('options', $this->arrayInfo);
  }

  public function add(){

    $this->arrayInfo['errorItems'] = array();

    if(isset($_SESSION['formError']) && count($_SESSION['formError']) > 0){
      $this->arrayInfo['errorItems'] = $_SESSION['formError'];
      unset($_SESSION['formError']);
    }

    $this->loadTemplate('options_add', $this->arrayInfo);

  }

  public function add_action(){
    if(!empty($_POST['name'])){

      $name  = $_POST['name'];
      $this->option->addOption($name);

      header("Location: ".BASE_URL."options");
      exit;

    }else{

      $_SESSION['formError'] = array('name');

      header("Location: ".BASE_URL."options/add");
      exit;
    }
  }

  public function edit($id){

    if(!empty($id)){
      $this->arrayInfo['errorItems'] = array();

      $this->arrayInfo['info'] = $this->option->getOption($id);

      if(isset($_SESSION['formError']) && count($_SESSION['formError']) > 0){
        $this->arrayInfo['errorItems'] = $_SESSION['formError'];
        unset($_SESSION['formError']);
      }

      $this->loadTemplate('options_edit', $this->arrayInfo);

    }else{

      header("Location: ".BASE_URL."options");
      exit;

    }
  }

  public function edit_action($id){
    if(!empty($id) && !empty($_POST['name'])){

      $name  = $_POST['name'];
      $this->option->editName($name, $id);

      header("Location: ".BASE_URL."options");
      exit;

    }else{

      //Observações
      $_SESSION['formError'] = array('name');

      header("Location: ".BASE_URL."options/edit/".$id);
      exit;

    }
  }

  public function del($id){

    if(!empty($id)){
      $this->option->delete($id);
    }

    header("Location: ".BASE_URL."options");
    exit;

  }

}
