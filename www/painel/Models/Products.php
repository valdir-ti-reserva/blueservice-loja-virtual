<?php

namespace Models;

use \Core\Model;
use \Models\Categories;
use \Models\Brands;

class Products extends Model {

	public function getAll():array {
    $array = array();

    $sql = "SELECT id, id_category, id_brand, name, stock, price_from, price FROM products";
    $sql = $this->db->query($sql);

    if($sql->rowCount() > 0){
      $c = new Categories();
      $b = new Brands();

      $array = $sql->fetchAll(\PDO::FETCH_ASSOC);

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
  }

  public function getProduct($id):array{

    $array = array();
    $sql = "SELECT * FROM products WHERE id=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();

    if($sql->rowCount() > 0){
      $array = $sql->fetch(\PDO::FETCH_ASSOC);
    }

    return $array;
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

    $sql = "DELETE FROM products WHERE id=:id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();

  }

}
