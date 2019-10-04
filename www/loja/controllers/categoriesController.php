<?php

class categoriesController extends Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index() {
      header("Location: ".BASE_URL);
    }

    public function enter($id){

      $dados      = array();

      $products   = new Products();
      $categories = new Categories();
      $cart       = new Cart();
      $f          = new Filters();

      $dados['category_name']   = $categories->getCategoryName($id);

      if(!empty($dados['category_name'])){

        $currentPage = 1;
        $offset      = 0;
        $limit       = 3;

        if(!empty($_GET['p'])){
          $currentPage = $_GET['p'];
        }

        $offset = ($currentPage * $limit) - $limit;

        //Filtrando os produtos por categoria
        $filters = array('category'=>$id);

        $dados['categories_filter'] = $categories->getCategoryTree($id);

        $dados['list']             = $products->getList($offset, $limit, $filters);
        $dados['totalItems']       = $products->getTotal($filters);
        $dados['numPages']         = ceil($dados['totalItems'] / $limit);
        $dados['currentPage']      = $currentPage;
        $dados['id_category']      = $id;
        $dados['categories']       = $categories->getList();
        $dados['filters']          = $f->getFilters($filters);
        $dados['filters_selected'] = $filters;
        $dados['sidebar']          = true;

        if(isset($_SESSION['cart'])){
          $qt = 0;
          foreach($_SESSION['cart'] as $qtd){
            $qt += intval($qtd);
          }
          $dados['cart_qt']        = $qt;
        }else{
          $dados['cart_qt']        = 0;
        }

        $dados['cart_subtotal']   = $cart->getSubtotal();

        $this->loadTemplate('categories', $dados);

      }else{

        header("Location: ".BASE_URL);

      }






    }

}
