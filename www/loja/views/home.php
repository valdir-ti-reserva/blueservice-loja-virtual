<div class="row">

  <?php
    $a = 0;
  ?>

  <?php foreach($list as $item):?>

    <div class="col-sm-4">

      <div class="product_item">

        <?php $this->loadView('product_item', $item); ?>

      </div>

    </div>

    <?php
      if($a >= 2){
        $a = 0;
        echo '</div><div class="row">';
      }else{
        $a++;
      }
    ?>

  <?php endforeach?>

</div>
