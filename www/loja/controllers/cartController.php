<?php

class cartController extends Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados    = array();
        $products = new Products();
        $cart     = new Cart();
        $cep      = '';
        $shipping = array();

        if(!empty($_POST['cep'])){
          $cep = intval($_POST['cep']);

          $shipping = $cart->shippingCalculator($cep);
          $_SESSION['shipping'] = $shipping;
        }

        if(!empty($_SESSION['shipping'])){
          $shipping = $_SESSION['shipping'];
        }

        if(!isset($_SESSION['cart']) || (isset($_SESSION['cart']) && count($_SESSION['cart']) == 0)){
          header("Location: ".BASE_URL);
          exit;
        }

        $dados['list'] = $cart->getList();

        if(isset($_SESSION['cart'])){
          $qt = 0;
          foreach($_SESSION['cart'] as $qtd){
            $qt += intval($qtd);
          }
          $dados['cart_qt'] = $qt;
        }else{
          $dados['cart_qt'] = 0;
        }

        $dados['shipping']      = $shipping;
        $dados['cart_subtotal'] = $cart->getSubtotal();


        $this->loadTemplate('cart', $dados);
    }

    public function add(){

      if(!empty($_POST['id_product'])){
        $id = intval($_POST['id_product']);
        $qt = intval($_POST['qt_product']);

        if(!isset($_SESSION['cart'])){
          $_SESSION['cart'] = array();
        }

        if($_SESSION['cart'][$id]){
          $_SESSION['cart'][$id] += $qt;
        }else{
          $_SESSION['cart'][$id] = $qt;
        }

      }

      header("Location: ".BASE_URL."cart");
      exit;

    }

    public function del($id){

      if(!empty($id)){

        unset($_SESSION['cart'][$id]);

      }

      header("Location: ".BASE_URL."cart");
      exit;
    }

}
