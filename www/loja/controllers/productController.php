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
        $cart        = new Cart();

        $info        = $products->getProductInfo($id);

        if(count($info) > 0 ){

          $dados['product_info']     = $info;
          $dados['product_images']   = $products->getImagesById($id);
          $dados['product_options']  = $products->getOptionsByProductId($id);
          $dados['product_rates']    = $products->getRates($id, 5);

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

          $this->loadTemplate('product', $dados);

        }else{

          header("Location: ".BASE_URL);

        }

  }
}
