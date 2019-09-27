<div class="product_item">

    <a href="">

      <div class="product_tags">

        <?php if($sale == 1):?>
          <div class="product_tag product_tag_red">Promoção</div>
        <?php endif?>

        <?php if($bestseller == 1):?>
          <div class="product_tag product_tag_green">Mais Vendidos</div>
        <?php endif?>

        <?php if($new_product == 1):?>
          <div class="product_tag product_tag_blue">Novo</div>
        <?php endif?>

      </div>

      <div class="product_image">
        <img src="<?=BASE_URL?>media/products/<?=$images[0]['url']?>" width="100%" alt="">
      </div>

      <div class="product_name"><?=$name?></div>
      <div class="product_brand"><?=$brand_name?></div>
      <div class="product_price_from"><?php if($price_from != 0) echo 'R$ '.number_format($price_from, 2, ',', '.');?></div>
      <div class="product_price">R$ <?=number_format($price, 2, ',', '.')?></div>

    </a>

</div>
