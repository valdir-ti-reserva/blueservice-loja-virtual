<?php
namespace Controllers;

use \Core\Controller;

class LoginController extends Controller {

	public function index() {
    $array = array();

    $this->loadView('login', array());
	}

}
