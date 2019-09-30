<?php

class categoriesController extends Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index() {

      // echo 'Categorias Admin';exit;

      $dados = array();

      $this->loadAdminTemplate('home', $dados);
    }


}
