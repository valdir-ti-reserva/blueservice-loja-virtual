<?php foreach($subs as $sub): ?>

  <option value="<?=$sub['id']?>">
    <?php
        for($q=0;$q<$level;$q++) echo '-- ';
        echo $sub['name'];
    ?>
  </option>

  <?php
    if(count($sub['subs']) > 0){
      $this->loadView('search_subcategory', array(
        'subs'  => $sub['subs'],
        'level' => $level + 1
      ));
    }
  ?>

<?php endforeach ?>
