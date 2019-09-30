<?php

class adminController extends Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $dados = array();

        $this->loadAdminTemplate('home', $dados);
    }

    public function categories() {

        $dados = array();

        $this->loadAdminTemplate('categories', $dados);
    }

}
