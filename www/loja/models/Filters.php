<?php

class Filters extends Model{


  public function getFilters($filters){

    $array = array(
      'brands'    =>array(),
      'slider0'   =>0,
      'slider1'   =>0,
      'maxSlider' =>1000,
      'stars'     =>array(
        '0'=>0,
        '1'=>0,
        '2'=>0,
        '3'=>0,
        '4'=>0,
        '5'=>0
      ),
      'sale'      =>0,
      'options'   =>array()
    );

    $brands          = new Brands();
    $products        = new Products() ;
    $array['brands'] = $brands->getList($filters);

    //Criando filtro de Preços
    if(isset($filters['slider0'])){
      $array['slider0'] = $filters['slider0'];
    }

    if(isset($filters['slider1'])){
      $array['slider1'] = $filters['slider1'];

    }

    $array['maxSlider'] = $products->getMaxPrice($filters);

    if($array['slider1'] == 0){
      $array['slider1'] = $array['maxSlider'];
    }

    //Criando o filtro das estrelas
    $star_products = $products->getListOfStars($filters);
    foreach($array['stars'] as $skey => $sitem){
      foreach($star_products as $sproduct){
        if($sproduct['rating'] == $skey){
          $array['stars'][$skey] = $sproduct['c'];
        }
      }
    }

    //Criando o filtro das promoções
    $array['sale'] = $products->getSaleCount($filters);

    //Criando o filtro das opções
    $array['options'] = $products->getAvailableOptions($filters);

    return $array;
  }

}
