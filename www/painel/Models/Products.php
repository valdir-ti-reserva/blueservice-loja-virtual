<?php

namespace Models;

use \Core\Model;
use \Models\Categories;
use \Models\Brands;

class Products extends Model {

	public function getAll():array {
    $array = array();
    $res = $this->simpleSelectFields('products', ['id', 'id_category', 'id_brand','name', 'stock', 'price_from', 'price']);

    if(!empty($res)){
      $c = new Categories();
      $b = new Brands();

      $array = $res;

      foreach($array as $k => $item){
        $brandInfo = $b->getBrand($item['id_brand']);
        $catInfo = $c->getCategory($item['id_category']);
        $array[$k]['name_brand']    = $brandInfo['name'];
        $array[$k]['name_category'] = $catInfo['name'];
      }
    }

		return $array;
  }

  public function addProduct($product = array()):void{

    $sql = "INSERT INTO products
              SET
                name=:name,
                id_brand=:id_brand,
                id_category=:id_category,
                description=:description,
                stock=:stock,
                price_from=:price_from,
                price=:price,
                weight=:weight,
                width=:width,
                height=:height,
                length=:length,
                diameter=:diameter,
                featured=:featured,
                sale=:sale,
                bestseller=:bestseller,
                new_product=:new_product
            ";

    $sql = $this->db->prepare($sql);
    $sql->bindValue(":name", $product['name']);
    $sql->bindValue(":id_brand", $product['id_brand']);
    $sql->bindValue(":id_category", $product['id_category']);
    $sql->bindValue(":description", $product['description']);
    $sql->bindValue(":stock", $product['stock']);
    $sql->bindValue(":price_from", $product['price_from']);
    $sql->bindValue(":price", $product['price']);
    $sql->bindValue(":weight", $product['weight']);
    $sql->bindValue(":width", $product['width']);
    $sql->bindValue(":height", $product['height']);
    $sql->bindValue(":length", $product['length']);
    $sql->bindValue(":diameter", $product['diameter']);
    $sql->bindValue(":featured", $product['featured']);
    $sql->bindValue(":sale", $product['sale']);
    $sql->bindValue(":bestseller", $product['bestseller']);
    $sql->bindValue(":new_product", $product['new_product']);
    $sql->execute();

    $id_inserido = $this->db->lastInsertId();
    $this->addOptions($id_inserido, $product['options']);

  }

  public function addOptions($id, $options){
    foreach($options as $k=>$opt){
      $this->complexInsert('products_options', $fields = array('id_product'=>$id, 'id_option'=>$k, 'p_value'=>$opt));
    }
  }

  public function getProduct($id):array{
    return $this->simpleGetId('products', '*', array('id'=>$id));
  }

  public function editProduct($product, $id):void{

    $sql = "UPDATE products SET
                name=:name,
                id_brand=:id_brand,
                id_category=:id_category,
                description=:description,
                stock=:stock,
                price_from=:price_from,
                price=:price,
                weight=:weight,
                width=:width,
                height=:height,
                length=:length,
                diameter=:diameter,
                featured=:featured,
                sale=:sale,
                bestseller=:bestseller,
                new_product=:new_product
            WHERE id=:id";

    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id",$id);
    $sql->bindValue(":name", $product['name']);
    $sql->bindValue(":id_brand", $product['id_brand']);
    $sql->bindValue(":id_category", $product['id_category']);
    $sql->bindValue(":description", $product['description']);
    $sql->bindValue(":stock", $product['stock']);
    $sql->bindValue(":price_from", $product['price_from']);
    $sql->bindValue(":price", $product['price']);
    $sql->bindValue(":weight", $product['weight']);
    $sql->bindValue(":width", $product['width']);
    $sql->bindValue(":height", $product['height']);
    $sql->bindValue(":length", $product['length']);
    $sql->bindValue(":diameter", $product['diameter']);
    $sql->bindValue(":featured", $product['featured']);
    $sql->bindValue(":sale", $product['sale']);
    $sql->bindValue(":bestseller", $product['bestseller']);
    $sql->bindValue(":new_product", $product['new_product']);
    $sql->execute();

  }

  public function delete($id){
    $this->deleteByID('products', $id);
  }

}
