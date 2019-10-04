<h2><?=$category_name?></h2>
<div class="row">

  <?php
    $a = 0;
  ?>

  <?php foreach($list as $item):?>

    <div class="col-sm-4 item-height">

        <?php $this->loadView('product_item', $item); ?>

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

<div class="paginationArea">
  <?php for($q=1;$q<=$numPages;$q++):?>
  <div class="pagination_item <?=($currentPage==$q)?'pag_active':''?>"><a href="<?=BASE_URL?>categories/enter/<?=$id_category?>?p=<?=$q?>"><?=$q?></a></div>
  <?php endfor?>
</div>
