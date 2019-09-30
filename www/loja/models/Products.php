<?php

class Products extends Model
{

    public function getList($offset = 0, $limit = 3, $filters = array())
    {
        $array = array();

        $util  = new Util();
        $where = $util->buildWhere($filters);

        $sql = "SELECT *,
                  (select brands.name from brands where brands.id = a.id_brand) as brand_name,
                    (select categories.name from categories where categories.id = a.id_category) as category_name
                      FROM products as a
                        WHERE ".implode(' AND ', $where)."
                          LIMIT $offset, $limit";
        $sql = $this->db->prepare($sql);

        $util->bindWhere($filters, $sql);

        $sql->execute();
        if($sql->rowCount() > 0){

            $array = $sql->fetchAll();

            foreach($array as $k => $item){

              $array[$k]['images'] = $this->getImagesById($item['id']);

            }

        }

        return $array;

    }

    public function getMaxPrice($filters = array()){

      $util  = new Util();
      $where = $util->buildWhere($filters);

      $sql = "SELECT price
                FROM products
                    ORDER BY price DESC
                      LIMIT 1";
      $sql = $this->db->prepare($sql);
      $util->bindWhere($filters, $sql);

      $sql->execute();
      if($sql->rowCount() > 0){

          $sql = $sql->fetch();
          return $sql['price'];

      }else{

          return '0';
      }

    }


    public function getListOfStars($filters = array()){
      $array = array();
      $util  = new Util();
      $where = $util->buildWhere($filters);

      $sql = "SELECT
                rating,
                  COUNT(id) AS c
                    FROM products
                      WHERE ".implode(' AND ', $where)."
                        GROUP BY rating";
      $sql = $this->db->prepare($sql);

      $util->bindWhere($filters, $sql);
      $sql->execute();

      if($sql->rowCount() > 0){
        $array = $sql->fetchAll();
      }

      return $array;
    }

    //Itens em promoção
    public function getSaleCount($filters = array()){

      $util  = new Util();
      $where = $util->buildWhere($filters);

      $where[] = 'sale="1"';

      $sql = "SELECT COUNT(*) AS c
                FROM products
                  WHERE ".implode(' AND ', $where);
      $sql = $this->db->prepare($sql);
      $util->bindWhere($filters, $sql);

      $sql->execute();
      if($sql->rowCount() > 0){

        $sql = $sql->fetch();
        return $sql['c'];

      }else{

        return '0';
      }

    }

    //Opções disponíveis
    public function getAvailableOptions($filters = array()){
      $groups = array();
      $ids    = array();

      $util  = new Util();
      $where = $util->buildWhere($filters);

      $sql = "SELECT id, options
                FROM products
                  WHERE ".implode(' AND ', $where)."
              ";
      $sql = $this->db->prepare($sql);

      $util->bindWhere($filters, $sql);

      $sql->execute();

      if($sql->rowCount() > 0){

        foreach($sql->fetchAll() as $product){
          $ops   = explode(",", $product['options']);
          $ids[] = $product['id'];

          foreach($ops as $op){

            if(!in_array($op, $groups)){
              $groups[] = $op;
            }

          }
        }
      }

      $options = $this->getAvailableValuesFromOptions($groups, $ids);

      return $options;

    }

    private function getAvailableValuesFromOptions($groups, $ids){
      $array = array();

      $options = new Options();

      foreach($groups as $op){
        $array[$op] = array(
          'name'=>$options->getName($op),
          'options'=>array()
        );
      }

      $sql = "SELECT
                p_value,
                  id_option,
                    COUNT(id_option) AS c
                      FROM products_options
                        WHERE
                          id_option  IN('".implode(',', $groups)."')
                            AND id_product IN('".implode(',', $ids)."')
                              GROUP BY p_value
                                ORDER BY id_option";


      $sql = $this->db->query($sql);

      if($sql->rowCount() > 0){
        foreach($sql->fetchAll() as $ops){

          $array[$ops['id_option']]['options'][] = array('value'=>$ops['p_value'],'count'=>$ops['c']);

        }
      }

      // return $array;
    }

    public function getInfo($id){
      $array = array();

      $sql = "SELECT * FROM products  WHERE id=:id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(":id", $id);
      $sql->execute();

      if($sql->rowCount() > 0){
        $array = $sql->fetch();
        $images = current($this->getImagesById($id));
        $array['image'] = $images['url'];
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

      $util  = new Util();
      $where = $util->buildWhere($filters);

      $sql = "SELECT
                COUNT(*) AS c
                  FROM products
                    WHERE ".(implode(' AND ', $where))."";
      $sql = $this->db->prepare($sql);

      $util->bindWhere($filters, $sql);

      $sql->execute();
      $sql = $sql->fetch();

      return $sql['c'];
    }

    public function getOptionsByProductId($id){
      $options = array();

      //1 - Recuperar os nomes da opções
      $sql = "SELECT options FROM products WHERE id=:id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(":id", $id);
      $sql->execute();

      if($sql->rowCount() > 0){

        $options = $sql->fetch();
        $options = $options['options'];

        if(!empty($options)){
          $sql = "SELECT * FROM options WHERE id IN(".$options.")";
          $sql = $this->db->query($sql);
          $options = $sql->fetchAll();
        }

        //2 - Receber os valores das opções
        $sql = "SELECT * FROM products_options WHERE id_product=:id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        $optionsValues = array();
        if($sql->rowCount() > 0){

          foreach($sql->fetchAll() as $op){

            $optionsValues[$op['id_option']] = $op['p_value'];

          }

        }

        //3 - Juntar os dois arrays
        foreach($options as $k => $op){

          if(isset($optionsValues[$op['id']])){

            $options[$k]['value'] = $optionsValues[$op['id']];

          }else{

            $options[$k]['value'] = '';

          }

        }

      }

      return $options;
    }

    public function getProductInfo($id){
      $array = array();

      if(!empty($id)){

        $sql = "SELECT *,
                  (select brands.name from brands where brands.id = products.id_brand) as brand_name
                  FROM products
                    WHERE id=:id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){

          $array = $sql->fetch();

        }

      }


      return $array;
    }

    public function getRates($id, $qtd){

      $array = array();

      $rates = new Rates();
      $array = $rates->getRates($id, $qtd);

      return $array;
    }

}
