<div class="row">
  <div class="col-sm-4">Fotos</div>
  <div class="col-sm-8">
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

      De: <span class="price_from">R$ <?=number_format($viewData['product_info']['price_from'], 2)?></span>
      Por: <span class="original_price">R$ <?=number_format($viewData['product_info']['price'], 2)?></span>

      <form action="POST" class="addToCartForm">

        <button data-action="decrease">-</button><input type="text" name="qt" value="1" class="addToCartQt" disabled><button data-action="increase">+</button>

        <input type="submit" value="Adicionar ao carrinho" class="addToCartSubmit">
      </form>

  </div>
</div>
