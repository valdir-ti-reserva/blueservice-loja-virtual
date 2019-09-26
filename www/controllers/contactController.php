<?php

class contactController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();
        $this->loadView('contact', $dados);
    }

}
