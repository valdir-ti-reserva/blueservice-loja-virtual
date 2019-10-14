<?php
namespace Controllers;

use \Core\Controller;
use \Models\Users;
use \Models\Brands;
use \Models\Products;
use \Models\Categories;
use \Models\Options;

class ProductsController extends Controller {

  private $user;
  private $arrayInfo;
  private $brand;
  private $product;
  private $category;
  private $option;

  public function __construct(){

    $this->user     = new Users();
    $this->brand    = new Brands();
    $this->product  = new Products();
    $this->category = new Categories();
    $this->option   = new Options();

    if(!$this->user->isLogged()){
      header("Location: ".BASE_URL."login");
      exit;
    }

    if(!$this->user->hasPermission('brands_view')){
      header("Location: ".BASE_URL);
      exit;
    }

    $this->arrayInfo = array(
      'user'=>$this->user,
      'menuActive'=>'products'
    );
  }

	public function index() {

    $this->arrayInfo['list'] = $this->product->getAll();
		$this->loadTemplate('products', $this->arrayInfo);
  }

  public function add(){

    $this->arrayInfo['cat_list']   = $this->category->getAll();
    $this->arrayInfo['brand_list'] = $this->brand->getAll();
    $this->arrayInfo['option_list'] = $this->option->getAll();
    $this->arrayInfo['errorItems']  = array();

    if(isset($_SESSION['formError']) && count($_SESSION['formError']) > 0){
      $this->arrayInfo['errorItems'] = $_SESSION['formError'];
      unset($_SESSION['formError']);
    }

    $this->loadTemplate('products_add', $this->arrayInfo);

  }

  public function add_action(){



    if(!empty($_POST['name']) &&
    !empty($_POST['id_category']) &&
    !empty($_POST['id_brand']) &&
    !empty($_POST['description'])
    ){

      $product = array();
      $product['name']        = $_POST['name'];
      $product['id_brand']    = $_POST['id_brand'];
      $product['id_category'] = $_POST['id_category'];
      $product['description'] = $_POST['description'];
      $product['stock']       = (!empty($_POST['stock']) ? $_POST['stock'] : 0);
      $product['price_from']  = (!empty($_POST['price_from']) ? $_POST['price_from'] : 0);
      $product['price']       = (!empty($_POST['price']) ? $_POST['price'] : 0);
      $product['weight']      = (!empty($_POST['weight']) ? $_POST['weight'] : 0);
      $product['width']       = (!empty($_POST['width']) ? $_POST['width'] : 0);
      $product['height']      = (!empty($_POST['height']) ? $_POST['height'] : 0);
      $product['length']      = (!empty($_POST['length']) ? $_POST['length'] : 0);
      $product['diameter']    = (!empty($_POST['diameter']) ? $_POST['diameter'] : 0);
      $product['featured']    = (isset($_POST['featured']) ? 1 : 0);
      $product['sale']        = (isset($_POST['sale']) ? 1 : 0);
      $product['bestseller']  = (isset($_POST['bestseller']) ? 1 : 0);
      $product['new_product'] = (isset($_POST['new_product']) ? 1 : 0);
      $product['options']     = $_POST['options'];

      $this->product->addProduct($product);

      header("Location: ".BASE_URL."products");
      exit;

    }else{

      $_SESSION['formError'] = array('name', 'id_category', 'id_brand', 'description');

      header("Location: ".BASE_URL."products/add");
      exit;
    }
  }

  public function edit($id){

    if(!empty($id)){

      $this->arrayInfo['cat_list']       = $this->category->getAll();
      $this->arrayInfo['brand_list']     = $this->brand->getAll();
      $this->arrayInfo['option_list']    = $this->option->getAll();

      $this->arrayInfo['errorItems'] = array();

      $this->arrayInfo['product'] = $this->product->getProduct($id);

      if(isset($_SESSION['formError']) && count($_SESSION['formError']) > 0){
        $this->arrayInfo['errorItems'] = $_SESSION['formError'];
        unset($_SESSION['formError']);
      }

      $this->loadTemplate('products_edit', $this->arrayInfo);

    }else{

      header("Location: ".BASE_URL."products");
      exit;

    }
  }

  public function edit_action($id){

    if(!empty($id) &&
        !empty($_POST['name']) &&
          !empty($_POST['id_category']) &&
            !empty($_POST['id_brand']) &&
              !empty($_POST['description'])
      ){

      $product = array();
      $product['id']          = $id;
      $product['name']        = $_POST['name'];
      $product['id_brand']    = $_POST['id_brand'];
      $product['id_category'] = $_POST['id_category'];
      $product['description'] = $_POST['description'];
      $product['stock']       = (!empty($_POST['stock']) ? $_POST['stock'] : 0);
      $product['price_from']  = (!empty($_POST['price_from']) ? $_POST['price_from'] : 0);
      $product['price']       = (!empty($_POST['price']) ? $_POST['price'] : 0);
      $product['weight']      = (!empty($_POST['weight']) ? $_POST['weight'] : 0);
      $product['width']       = (!empty($_POST['width']) ? $_POST['width'] : 0);
      $product['height']      = (!empty($_POST['height']) ? $_POST['height'] : 0);
      $product['length']      = (!empty($_POST['length']) ? $_POST['length'] : 0);
      $product['diameter']    = (!empty($_POST['diameter']) ? $_POST['diameter'] : 0);
      $product['featured']    = (isset($_POST['featured']) ? 1 : 0);
      $product['sale']        = (isset($_POST['sale']) ? 1 : 0);
      $product['bestseller']  = (isset($_POST['bestseller']) ? 1 : 0);
      $product['new_product'] = (isset($_POST['new_product']) ? 1 : 0);

      $this->product->editProduct($product, $id);

      header("Location: ".BASE_URL."products");
      exit;

    }else{

      $_SESSION['formError'] = array('name', 'id_category', 'id_brand', 'description');

      header("Location: ".BASE_URL."products/edit/".$id);
      exit;

    }
  }

  public function del($id){

    if(!empty($id)){
      $this->product->delete($id);
    }

    header("Location: ".BASE_URL."products");
    exit;

  }

}
