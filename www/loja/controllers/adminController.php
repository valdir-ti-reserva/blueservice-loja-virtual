<?php

class adminController extends Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $dados = array();

        $this->loadAdminView('template', $dados);
    }

}
