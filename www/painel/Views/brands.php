<section class="content-header">
  <h1>
    Marcas
  </h1>
</section>

<!-- Main content -->
<section class="content container-fluid">

  <!--------------------------
  | Your Page Content Here   |
  --------------------------->
  <div class="box">
      <div class="box-header">
        <h3 class="box-title">Marcas</h3>
        <div class="box-tools">

          <a href="<?=BASE_URL?>brands/add" class="btn btn-success">Adicionar</a>

        </div>
      </div>

    <div class="box-body">

      <table class="table">

        <tr>
          <th>Nome da Marca</th>
          <th width="220">Ações</th>
        </tr>

        <?php foreach($list as $item):?>
          <tr>
            <td><?=$item['name'];?>
            </td>
            <td>
              <div class="btn-group">
                <a href="<?=BASE_URL?>brands/edit/<?=$item['id']?>" class="btn btn-xs btn-primary">Editar</a>
                <a href="<?=BASE_URL?>brands/del/<?=$item['id']?>" onclick="return confirm('Deseja realmente excluir essa marca?')" class="btn btn-xs btn-danger">Excluir</a>
              </div>
            </td>
          </tr>

        <?php endforeach?>

      </table>

    </div>

  </div>

</section>
