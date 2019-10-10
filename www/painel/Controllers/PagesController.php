<?php
namespace Controllers;

use \Core\Controller;
use \Models\Users;
use \Models\Pages;

class PagesController extends Controller {

  private $user;
  private $arrayInfo;
  private $pages;

  public function __construct(){

    $this->user  = new Users();
    $this->pages = new Pages();

    if(!$this->user->isLogged()){
      header("Location: ".BASE_URL."login");
      exit;
    }

    if(!$this->user->hasPermission('pages_view')){
      header("Location: ".BASE_URL);
      exit;
    }

    $this->arrayInfo = array(
      'user'=>$this->user,
      'menuActive'=>'pages'
    );

  }

	public function index() {

    $this->$arrayInfo['list'] = $this->pages->getAll();
    $this->loadTemplate('pages', $this->arrayInfo);

  }

  public function add(){

    $this->arrayInfo['errorItems'] = array();

    if(isset($_SESSION['formError']) && count($_SESSION['formError']) > 0){
      $this->arrayInfo['errorItems'] = $_SESSION['formError'];
      unset($_SESSION['formError']);
    }

    $this->loadTemplate('pages_add', $this->arrayInfo);

  }

  public function add_action(){

    if(!empty($_POST['title'])){

      $title = $_POST['title'];
      $body = $_POST['body'];

      $this->pages->add($title, $body);

      header("Location: ".BASE_URL."pages");
      exit;

    }else{

      $_SESSION['formError'] = array('title');

      header("Location: ".BASE_URL."pages/add");
      exit;

    }

  }

  public function del($id){

    if(!empty($id)){
      $this->pages->del($id);
    }

    header("Location: ".BASE_URL."pages");
    exit;
  }

  public function edit($id){
      if(!empty($id)){

        $this->arrayInfo['page'] = $this->pages->getPage($id);

        $this->arrayInfo['errorItems'] = array();

        if(isset($_SESSION['formError']) && count($_SESSION['formError']) > 0){
          $this->arrayInfo['errorItems'] = $_SESSION['formError'];
          unset($_SESSION['formError']);
        }

        if(count($this->arrayInfo['page']) > 0){
          $this->loadTemplate("pages_edit", $this->arrayInfo);
        }else{
          header("Location: ".BASE_URL."pages");
          exit;
        }

      }else{

        header("Location: ".BASE_URL."pages");
        exit;
      }
  }

  public function edit_action($id){
    if(!empty($id)){

      if(!empty($_POST['title'])){

        $title = $_POST['title'];
        $body = $_POST['body'];

        $this->pages->edit($id, $title, $body);

        header("Location: ".BASE_URL."pages");
        exit;

      }else{

        $_SESSION['formError'] = array('title');

        header("Location: ".BASE_URL."pages/edit/".$id);
        exit;
      }

    }else{

      header("Location: ".BASE_URL."pages");
      exit;

    }
  }

  public function upload(){

    if(!empty($_FILES['file']['tmp_name'])){
      $types_allowed = array('image/jpeg', 'image/jpg', 'image/png');

      if(in_array($_FILES['file']['type'], $types_allowed)){

        $new_name = md5(time().rand(0,999).rand(0,999)).'.jpg';
        move_uploaded_file($_FILES['file']['tmp_name'], '../loja/media/pages/'.$new_name);

        $array = array(
          'location'=>BASE_URL_SITE.'media/pages/'.$new_name
        );

        echo json_encode($array);
        exit;

      }

    }

  }

}
