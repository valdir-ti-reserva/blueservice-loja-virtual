<section class="content-header">
      <h1>
        Categorias
      </h1>
    </section>

    <!--------------------------
    | Your Page Content Here   |
    --------------------------->

     <!-- Main content -->
    <section class="content container-fluid">

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Categorias</h3>
            <div class="box-tools">

              <a href="<?=BASE_URL?>categories/add" class="btn btn-success">Adicionar</a>

          </div>
        </div>
        <div class="box-body">

          <table class="table">

            <tr>
              <th>Nome da Categoria</th>
              <th width="220">Ações</th>
            </tr>

            <?php foreach($list as $item):?>
              <tr>
                <td><?=$item['name']?></td>
                <td>
                  <div class="btn-group">
                    <a href="<?=BASE_URL?>categories/edit/<?=$item['id']?>" class="btn btn-xs btn-primary">Editar</a>
                    <a href="<?=BASE_URL?>categories/del/<?=$item['id']?>" onclick="return confirm('Deseja realmente excluir o grupo?')" class="btn btn-xs btn-danger">Excluir</a>
                  </div>
                </td>
              </tr>
            <?php endforeach?>

          </table>

        </div>
      </div>

    </section>
