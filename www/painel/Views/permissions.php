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
          <h3 class="box-title">Grupos de Permissões</h3>
          <div class="box-tools">
            <a href="<?=BASE_URL?>permissions/add" class="btn btn-success">Adicionar</a>
          </div>
        </div>
        <div class="box-body">

          <table class="table">

            <tr>
              <th>Nome da Permissão</th>
              <th>Qtd. de Ativos</th>
              <th width="220">Ações</th>
            </tr>

            <?php foreach($list as $item):?>
              <tr>
                <td><?=$item['name']?></td>
                <td><?=$item['total_users']?></td>
                <td>
                  <div class="btn-group">
                    <a href="<?=BASE_URL?>permissions/edit/<?=$item['id']?>" class="btn btn-xs btn-primary">Editar</a>
                    <a href="<?=BASE_URL?>permissions/del/<?=$item['id']?>" class="btn btn-xs btn-danger <?php echo($item['total_users']!=0?'disabled':'');?>">Excluir</a>
                  </div>
                </td>
              </tr>
            <?php endforeach?>

          </table>

        </div>
      </div>


    </section>
