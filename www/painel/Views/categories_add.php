<section class="content-header">
      <h1>
        Categorias
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
        | Your Page Content Here   |
        --------------------------->




        <form action="<?=BASE_URL?>categories/add_action" method="POST">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Nova Categoria</h3>
              <div class="box-tools">
                <input type="submit" class="btn btn-success" value="Salvar">
              </div>
            </div>
            <div class="box-body">

              <div class="form-group <?= (in_array('name', $errorItems))?'has-error':'' ?>">
                <label for="group_name">Nome da Categoria</label>
                <input type="text" class="form-control" id="category_name" name="name" autocomplete="off"/>
              </div>

              <div class="form-group">

                <label for="group_name">Categoria Pai</label>
                <select name="sub" id="sub" class="form-control">

                <option value="">Nenhuma</option>

                <?php $this->loadView('categories_select', array(
                  'itens'=>$list,
                  'level'=>0
                ));?>

                </select>

              </div>

            </div>
          </div>

        </form>

    </section>
