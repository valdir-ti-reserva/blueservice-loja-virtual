<?php

class Categories extends Model
{

  public function getList(){

      $array = array();

      $sql = "SELECT * FROM categories ORDER BY sub DESC";//Buscando todas as categorias juntamente com as subcategorias
      $sql = $this->db->query($sql);

      if($sql->rowCount() > 0){

        foreach($sql->fetchAll() as $item){
          $item['subs']       = array();
          $array[$item['id']] = $item;//Organizando o array com cada subcategoria que ele possui
        }

        while($this->stillNeed($array)){

          $this->organizeCategory($array);

        }
      }

      return $array;
  }

  //Buscando a arvore da categoria
  public function getCategoryTree($id){

    $array     = array();
    $haveChild = true;

    while($haveChild){

      $sql = "SELECT * FROM categories WHERE id = :id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(":id", $id);
      $sql->execute();
      if($sql->rowCount()){

        $sql     = $sql->fetch();
        $array[] = $sql;

        if(!empty($sql['sub'])){

          $id = $sql['sub'];

        }else{

          $haveChild = false;

        }

      }

    }

    $array = array_reverse($array);

    return $array;

  }


  //Organizando o array as subcategorias até que fiquem somente as categorias "PAI"
  private function organizeCategory(&$array){//Utilizando ponteiro para diretamente alterar o array por parametro

    foreach($array as $id => $item){

      if(isset($array[$item['sub']])){//Verifica se a subcategoria existe
        $array[$item['sub']]['subs'][$item['id']] = $item;//Atribui o array filho ao PAI
        unset($array[$id]);//Apagando o item alocado no outro array
        break;
      }

    }

  }


  //Verifica até o sub ficar vazio, e as categorias fiqeum somente as categorias "PAI"
  private function stillNeed($array){

    foreach($array as $item){
      if(!empty($item['sub'])){
        return true;
      }
    }

    return false;
  }
}
