<div class="row">

  <div class="col-sm-5">

    <div class="mainPhotho">

      <img src="<?=BASE_URL?>media/products/<?=$viewData['product_images'][0][0]?>" alt="">

    </div>

    <div class="gallery">

      <?php foreach($viewData['product_images'] as $img):?>

        <div class="photoItem">

          <img src="<?=BASE_URL?>/media/products/<?=$img['url']?>" alt="">

        </div>

      <?php endforeach ?>

    </div>

  </div>

  <div class="col-sm-7">

    <h3><?=$viewData['product_info']['name']?></h3>
    <small><?=$viewData['product_info']['brand_name']?></small><br>

    <?php if($viewData['product_info']['rating'] != '0'): ?>

      <?php for($q=0;$q<intval($viewData['product_info']['rating']);$q++):?>

        <img src="<?=BASE_URL?>assets/images/star.png" alt="" height="15px">

      <?php endfor ?>

    <?php endif ?>

    <hr>
    <p><?=$viewData['product_info']['description']?></p>
    <hr>

    De: <span class="price_from">R$ <?=number_format($viewData['product_info']['price_from'], 2)?></span><br>
    Por: <span class="original_price">R$ <?=number_format($viewData['product_info']['price'], 2)?></span>

      <form action="POST" class="addToCartForm">

        <button data-action="decrease">-</button><input type="text" name="qt" value="1" class="addToCartQt" disabled><button data-action="increase">+</button>

        <input type="submit" value="Adicionar ao carrinho" class="addToCartSubmit">

      </form>

  </div>

</div>
<br>
<div class="row">


  <div class="col-sm-6">

    <h2>Especificações</h2>

    <?php foreach($viewData['product_options'] as $po):?>
      <strong><?=$po['name']?>: </strong><span><?=$po['value']?></span><br>
    <?php endforeach?>

  </div>

  <div class="col-sm-6">

    <h2>Reviews</h2>

    <?php foreach($viewData['product_rates'] as $po):?>

      <strong><?=$po['user_name']?></strong>

      <?php for($q=0;$q<intval($po['points']);$q++):?>

        <img src="<?=BASE_URL?>/assets/images/star.png" alt="" height="15px">

      <?php endfor?>

      <br>

      "<?=$po['comment']?>"
      <hr>

    <?php endforeach?>

  </div>

</div>
