<section class="content-header">
      <h1>
        Permissões
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Itens de Permissões</h3>
          <div class="box-tools">

            <a href="<?=BASE_URL?>permissions/items_add" class="btn btn-success">Adicionar</a>

          </div>
        </div>
        <div class="box-body">

          <table class="table">

            <tr>
              <th>Nome do item de Permissão</th>
              <th>Slug</th>
              <th width="220">Ações</th>
            </tr>

            <?php foreach($list as $item):?>
              <tr>
                <td><?=$item['name']?></td>
                <td><?=$item['slug']?></td>
                <td>
                  <div class="btn-group">
                    <a href="<?=BASE_URL?>permissions/items_edit/<?=$item['id']?>" class="btn btn-xs btn-primary">Editar</a>
                    <a href="<?=BASE_URL?>permissions/items_del/<?=$item['id']?>" onclick="return confirm('Deseja realmente excluir o item?')" class="btn btn-xs btn-danger">Excluir</a>
                  </div>
                </td>
              </tr>
            <?php endforeach?>

          </table>

        </div>
      </div>


    </section>
