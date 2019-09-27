<?php

class homeController extends Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();

        $products = new Products();

        $dados['list'] = $products->getList();

        $this->loadTemplate('home', $dados);
    }

}
