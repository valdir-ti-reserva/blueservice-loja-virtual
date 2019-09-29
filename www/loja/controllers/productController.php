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
        $info_images = $products->getImagesById($id);

        if(count($info) > 0 ){

          $dados['product_info']     = $info;
          $dados['product_images']   = $info_images;
          $dados['categories']       = $categories->getList();

          $dados['filters']          = $f->getFilters($filters);
          $dados['filters_selected'] = array();

          $this->loadTemplate('product', $dados);

        }else{

          header("Location: ".BASE_URL);

        }

  }
}
