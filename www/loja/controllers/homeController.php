<?php

class homeController extends Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();

        $products    = new Products();
        $categories  = new Categories();
        $f           = new Filters();

        $filters     = array();
        if(!empty($_GET['filter']) && is_array($_GET['filter'])){
          $filters = $_GET['filter'];
        }

        $currentPage = 1;
        $offset      = 0;
        $limit       = 3;

        if(!empty($_GET['p'])){
          $currentPage = $_GET['p'];
        }

        $offset = ($currentPage * $limit) - $limit;

        $dados['list']             = $products->getList($offset, $limit, $filters);
        $dados['totalItems']       = $products->getTotal($filters);
        $dados['numPages']         = ceil($dados['totalItems'] / $limit);
        $dados['currentPage']      = $currentPage;
        $dados['categories']       = $categories->getList();
        $dados['filters']          = $f->getFilters($filters);
        $dados['filters_selected'] = $filters;
        $dados['sidebar']          = true;

        $this->loadTemplate('home', $dados);
    }

}
