<?php

class Rates extends Model{

  public function getRates($id, $qtd){

    $array = array();

    $sql = "SELECT *,
              (select users.name from users where users.id = rates.id_user) AS user_name
                FROM rates
                  WHERE id_product=:id
                    ORDER BY date_rated
                      DESC LIMIT ".$qtd;
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();

    if($sql->rowCount() > 0){

      $array = $sql->fetchAll();

    }

    return $array;
  }
}
