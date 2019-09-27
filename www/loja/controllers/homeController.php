<?php

class homeController extends Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();

        $products = new Products();

        $currentPage = 1;
        $offset      = 0;
        $limit       = 3;

        if(!empty($_GET['p'])){
          $currentPage = $_GET['p'];
        }

        $offset = ($currentPage * $limit) - $limit;

        $dados['list']        = $products->getList($offset, $limit);
        $dados['totalItems']  = $products->getTotal();
        $dados['numPages']    = ceil($dados['totalItems'] / $limit);
        $dados['currentPage'] = $currentPage;

        $this->loadTemplate('home', $dados);
    }

}
