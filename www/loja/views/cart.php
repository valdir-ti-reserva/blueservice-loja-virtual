<h2>Carrinho de compras</h2>

<table width="100%" class="table table-striped">

  <tr border="0">
    <th width="100">Imagem</th>
    <th>Nome</th>
    <th width="100">Qtd</th>
    <th width="110">Preço</th>
    <th width="20"></th>
  </tr>


  <?php
    $subtotal = 0;
  ?>
  <?php foreach($list as $item):?>

  <?php $subtotal += (floatval($item['price']) * intval($item['qt']))  ?>

    <tr>
      <td><img src="<?=BASE_URL?>media/products/<?=$item['image']?>" alt="" width="100px"></td>
      <td><?=$item['name']?></td>
      <td><?=$item['qt']?></td>
      <td>R$ <?=number_format($item['price'], 2, ',' ,'.')?></td>
      <td>
        <a href="<?=BASE_URL?>cart/del/<?=$item['id']?>">
          <img src="<?=BASE_URL?>assets/images/delete.png" alt="Apagar" width="22px">
        </a>
      </td>
    </tr>

  <?php endforeach?>
  <tr>
    <td colspan="3" align="right">Subtotal</td>
    <td><strong>R$ <?=number_format($subtotal, 2, ',' ,'.')?></strong></td>
  </tr>


</table>
