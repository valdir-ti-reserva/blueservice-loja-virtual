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

}
