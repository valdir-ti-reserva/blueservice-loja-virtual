<?php foreach($itens as $item):?>

  <option value="<?=$item['id']?>">
    <?php for($q=0;$q<$level;$q++) echo '--  ';?>
    <?=$item['name']?>
  </option>

  <?php
    if(count($item['subs']) > 0){
      $this->loadView('categories_select', array(
        'itens'=>$item['subs'],
        'level'=>$level + 1
      ));
    }
  ?>

<?php endforeach?>
