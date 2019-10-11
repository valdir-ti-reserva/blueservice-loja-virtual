<section class="content-header">
      <h1>
        Opções
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <form action="<?=BASE_URL?>options/edit_action/<?=$info['id']?>" method="POST">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Editar Opção</h3>
              <div class="box-tools">
                <input type="submit" class="btn btn-success" value="Salvar">
              </div>
            </div>
            <div class="box-body">

              <div class="form-group <?= (in_array('name', $errorItems))?'has-error':'' ?>">
                <label for="option_name">Nome da Opção</label>
                <input type="text" class="form-control" id="option_name" name="name" value="<?=$info['name']?>"/>
              </div>

            </div>
          </div>

        </form>

    </section>
