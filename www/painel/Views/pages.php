<section class="content-header">
  <h1>
    Páginas
  </h1>
</section>

<!--------------------------
| Your Page Content Here   |
--------------------------->

<!-- Main content -->
<section class="content container-fluid">

  <div class="box">

    <div class="box-header">
      <h3 class="box-title">Páginas</h3>
      <div class="box-tools">

        <a href="<?=BASE_URL?>pages/add" class="btn btn-success">Adicionar</a>

      </div>
    </div>

  <div class="box-body">

    <table class="table table-striped">

      <tr>
        <th>Título da Página</th>
        <th width="220">Ações</th>
      </tr>

      <?php foreach($this->$arrayInfo['list'] as $item):?>
        <tr>
          <td><?=$item['title']?></td>
          <td>
            <div class="btn-group">
              <a href="<?=BASE_URL?>pages/edit/<?=$item['id']?>" class="btn btn-xs btn-primary">Editar</a>
              <a href="<?=BASE_URL?>pages/del/<?=$item['id']?>" onclick="return confirm('Deseja realmente excluir essa página?')" class="btn btn-xs btn-danger">Excluir</a>
            </div>
          </td>
        </tr>
      <?php endforeach?>

    </table>

    </div>

  </div>

</section>
