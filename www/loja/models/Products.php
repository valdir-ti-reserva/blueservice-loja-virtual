<?php

class Products extends Model
{

    public function getList($offset = 0, $limit = 3, $filters = array())
    {
        $array = array();

        $where = array('1=1');

        if(!empty($filters['category'])){
          $where[] = "id_category = :id_category";
        }

        $sql = "SELECT *,
                  (select brands.name from brands where brands.id = a.id_brand) as brand_name,
                    (select categories.name from categories where categories.id = a.id_category) as category_name
                      FROM products as a
                        WHERE ".implode(' AND ', $where)."
                          LIMIT $offset, $limit";
        $sql = $this->db->prepare($sql);

        if(!empty($filters['category'])){
          $sql->bindValue(":id_category", $filters['category']);
        }

        $sql->execute();
        if($sql->rowCount() > 0){

            $array = $sql->fetchAll();

            foreach($array as $k => $item){

              $array[$k]['images'] = $this->getImagesById($item['id']);

            }

        }

        return $array;

    }

    public function getImagesById($id)
    {
      $array = array();

      $sql = "SELECT url FROM products_images WHERE id_product = :id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(":id", $id);
      $sql->execute();

      if($sql->rowCount()){
        $array = $sql->fetchAll();
      }

      return $array;
    }

    public function getTotal($filters = array())
    {

      $where = array('1=1');

      if(!empty($filters['category'])){
        $where[] = "id_category = :id_category";
      }

      $sql = "SELECT
                COUNT(*) AS c
                  FROM products
                    WHERE ".(implode(' AND ', $where))."";
      $sql = $this->db->prepare($sql);

      if(!empty($filters['category'])){
        $sql->bindValue(":id_category", $filters['category']);
      }

      $sql->execute();
      $sql = $sql->fetch();

      return $sql['c'];
    }

}
