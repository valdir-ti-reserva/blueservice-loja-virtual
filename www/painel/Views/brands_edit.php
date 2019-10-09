<section class="content-header">
      <h1>
        Marcas
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <form action="<?=BASE_URL?>brands/edit_action/<?=$viewData['brand']['id']?>" method="POST">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Editar Marca</h3>
              <div class="box-tools">
                <input type="submit" class="btn btn-success" value="Salvar">
              </div>
            </div>
            <div class="box-body">

              <div class="form-group <?= (in_array('name', $errorItems))?'has-error':'' ?>">
                <label for="group_name">Nome da Marca</label>
                <input type="text" class="form-control" id="brand_name" name="name" value="<?=$viewData['brand']['name']?>"/>
              </div>

            </div>
          </div>

        </form>

    </section>
