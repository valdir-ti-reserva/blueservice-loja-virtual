<section class="content-header">
  <h1>
    Produtos
  </h1>
</section>

<!-- Main content -->
<section class="content container-fluid">

  <!--------------------------
  | Your Page Content Here   |
  --------------------------->
  <div class="box">
      <div class="box-header">
        <h3 class="box-title">Produtos</h3>
        <div class="box-tools">

          <a href="<?=BASE_URL?>options" class="btn btn-primary">Opções do Produto</a>
          <a href="<?=BASE_URL?>products/add" class="btn btn-success">Adicionar</a>

        </div>
      </div>

    <div class="box-body">

      <table class="table">

        <tr>
          <th>Categoria</th>
          <th>Nome Produto</th>
          <th>Estoque</th>
          <th>Preço</th>
          <th width="220">Ações</th>
        </tr>

        <?php foreach($list as $item):?>
          <tr>
            <td><?=$item['name_category'];?></td>
            <td><?=$item['name'];?><br><small><?=$item['name_brand']?></small></td>
            <td><?=$item['stock'];?></td>
            <td><small><strike>R$ <?=number_format($item['price_from'], 2, ',', '.');?></strike></small><br>R$ <?=number_format($item['price'], 2, ',', '.')?></td>
            <td>
              <div class="btn-group">
                <a href="<?=BASE_URL?>products/edit/<?=$item['id']?>" class="btn btn-xs btn-primary">Editar</a>
                <a href="<?=BASE_URL?>products/del/<?=$item['id']?>" onclick="return confirm('Deseja realmente excluir o produto?')" class="btn btn-xs btn-danger">Excluir</a>
              </div>
            </td>
          </tr>

        <?php endforeach?>

      </table>

    </div>

  </div>

</section>
