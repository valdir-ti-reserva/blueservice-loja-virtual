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
        <form action="<?=BASE_URL?>permissions/add_action" method="POST">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Novo Grupos de Permissão</h3>
              <div class="box-tools">
                <input type="submit" class="btn btn-success" value="Salvar">
              </div>
            </div>
            <div class="box-body">

              <div class="form-group">
                <label for="group_name">Nome do grupo</label>
                <input type="text" class="form-control" id="group_name" name="name"/>
              </div>

              <hr>

              <?php foreach($permission_items as $item):?>
                <div class="form-group">
                  <input type="checkbox" name="items[]" value="<?=$item['id']?>" id="item-<?=$item['id']?>"/>
                  <label for="item-<?=$item['id']?>"><?=$item['name']?></label>
                </div>
              <?php endforeach?>

            </div>
          </div>

        </form>

    </section>
