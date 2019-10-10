<section class="content-header">
  <h1>
    Páginas
  </h1>
</section>

  <!-- Main content -->
<section class="content container-fluid">

      <!--------------------------
      | Your Page Content Here   |
      --------------------------->

      <form action="<?=BASE_URL?>pages/edit_action/<?=$page['id']?>" method="POST">

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Editar Página</h3>
            <div class="box-tools">
              <input type="submit" class="btn btn-success" value="Salvar">
            </div>
          </div>
          <div class="box-body">

            <div class="form-group <?= (in_array('title', $errorItems))?'has-error':'' ?>">
              <label for="page_title">Nome da Página</label>
              <input type="text" class="form-control" id="page_title" name="title" autocomplete="off" value="<?=$page['title']?>"/>
            </div>

            <div class="form-group <?= (in_array('body', $errorItems))?'has-error':'' ?>">
              <label for="page_body">Corpo da Página</label>
              <textarea name="body" id="page_body" cols="30" rows="10"><?=$page['body']?></textarea>
            </div>

          </div>
        </div>

      </form>

</section>
