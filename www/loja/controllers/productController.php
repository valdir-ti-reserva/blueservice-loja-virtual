<?php

class productController extends Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index() {

      header("Location: ".BASE_URL);

    }

    public function open($id){
        $dados = array();

        $products    = new Products();
        $categories  = new Categories();
        $f           = new Filters();
        $filters     = array();

        $info        = $products->getProductInfo($id);

        if(count($info) > 0 ){

          $dados['product_info']     = $info;
          $dados['product_images']   = $products->getImagesById($id);
          $dados['product_options']  = $products->getOptionsByProductId($id);
          $dados['product_rates']    = $products->getRates($id, 5);

          $dados['categories']       = $categories->getList();

          $dados['filters']          = $f->getFilters($filters);
          $dados['filters_selected'] = array();

          $this->loadTemplate('product', $dados);

        }else{

          header("Location: ".BASE_URL);

        }

  }
}
