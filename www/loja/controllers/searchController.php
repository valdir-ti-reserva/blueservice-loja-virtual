<?php

class searchController extends Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();

        $products    = new Products();
        $categories  = new Categories();

        if(!empty($_GET['s'])){
          $searchTerm = $_GET['s'];

          $currentPage = 1;
          $offset      = 0;
          $limit       = 3;

          if(!empty($_GET['p'])){
            $currentPage = $_GET['p'];
          }

          $offset = ($currentPage * $limit) - $limit;

          $dados['list']            = $products->getList($offset, $limit);
          $dados['totalItems']      = $products->getTotal();
          $dados['numPages']        = ceil($dados['totalItems'] / $limit);
          $dados['currentPage']     = $currentPage;
          $dados['categories']      = $categories->getList();
          $dados['search_term']     = $searchTerm;

          $this->loadTemplate('search', $dados);

        }else{

          header("Location: ".BASE_URL);

        }
    }

}
