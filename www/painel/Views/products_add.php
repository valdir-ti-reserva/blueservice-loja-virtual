<section class="content-header">
  <h1>
    Produtos
  </h1>
</section>

  <!-- Main content -->
<section class="content container-fluid">

      <!--------------------------
      | Your Page Content Here   |
      --------------------------->

      <form action="<?=BASE_URL?>products/add_action" method="POST">

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Novo Produto</h3>
            <div class="box-tools">
              <input type="submit" class="btn btn-success" value="Salvar">
            </div>
          </div>
          <div class="box-body">

            <div class="form-group <?= (in_array('id_category', $errorItems))?'has-error':'' ?>">
              <label for="p_cat">Categoria</label>
              <select required="required" name="id_category" id="p_cat" class="form-control">
                <option value="">Selecione a Categoria</option>

                  <?php $this->loadView('categories_select', array(
                    'itens'=>$cat_list,
                    'level'=>0
                  ));?>

              </select>
            </div>

            <div class="form-group <?= (in_array('id_brand', $errorItems))?'has-error':'' ?>">
              <label for="p_brand">Marca</label>
              <select required="required" name="id_brand" id="p_brand" class="form-control">
                <option value="">Selecione a Marca</option>
                <?php foreach($brand_list as $b):?>
                  <option value="<?=$b['id']?>"><?=$b['name']?></option>
                <?php endforeach?>
              </select>
            </div>

            <div class="form-group <?= (in_array('name', $errorItems))?'has-error':'' ?>">
              <label for="p_name">Nome do Produto</label>
              <input required type="text" class="form-control" id="p_name" name="name" autocomplete="off"/>
            </div>

            <div class="form-group <?= (in_array('description', $errorItems))?'has-error':'' ?>">
              <label for="p_description">Descrição do Produto</label>
              <textarea name="description" id="p_description" cols="30" rows="10"></textarea>
            </div>

            <div class="form-group <?= (in_array('stock', $errorItems))?'has-error':'' ?>">
              <label for="p_stock">Estoque Disponível</label>
              <input required type="number" class="form-control" id="p_stock" name="stock" autocomplete="off"/>
            </div>

            <div class="form-group <?= (in_array('price_from', $errorItems))?'has-error':'' ?>">
              <label for="p_price_from">Preço (de)</label>
              <input type="text" class="form-control" id="p_price_from" name="price_from" autocomplete="off"/>
            </div>

            <div class="form-group <?= (in_array('price', $errorItems))?'has-error':'' ?>">
              <label for="p_price">Preço (por)</label>
              <input required type="text" class="form-control" id="p_price" name="price" autocomplete="off"/>
            </div>

            <hr>

            <div class="form-group <?= (in_array('diameter', $errorItems))?'has-error':'' ?>">
              <label for="p_weight">Peso (em KG)</label>
              <input type="text" class="form-control" id="p_weight" name="weight" autocomplete="off"/>
            </div>

            <div class="form-group <?= (in_array('width', $errorItems))?'has-error':'' ?>">
              <label for="p_width">Largura (em CM)</label>
              <input type="text" class="form-control" id="p_width" name="width" autocomplete="off"/>
            </div>

            <div class="form-group <?= (in_array('height', $errorItems))?'has-error':'' ?>">
              <label for="p_height">Altura (em CM)</label>
              <input type="text" class="form-control" id="p_height" name="height" autocomplete="off"/>
            </div>

            <div class="form-group <?= (in_array('length', $errorItems))?'has-error':'' ?>">
              <label for="p_length">Comprimento (em CM)</label>
              <input type="text" class="form-control" id="p_length" name="length" autocomplete="off"/>
            </div>

            <div class="form-group <?= (in_array('diameter', $errorItems))?'has-error':'' ?>">
              <label for="p_diameter">Diametro (em CM)</label>
              <input type="text" class="form-control" id="p_diameter" name="diameter" autocomplete="off"/>
            </div>

            <hr>

            <div class="form-group <?= (in_array('featured', $errorItems))?'has-error':'' ?>">
              <label for="p_featured">Em Destaque</label><br>
              <input type="checkbox" id="p_featured" name="featured"/>
            </div>

            <div class="form-group <?= (in_array('sale', $errorItems))?'has-error':'' ?>">
              <label for="p_sale">Em Promoção</label><br>
              <input type="checkbox" id="p_sale" name="sale"/>
            </div>

            <div class="form-group <?= (in_array('bestseller', $errorItems))?'has-error':'' ?>">
              <label for="p_bestseller">Mais Vendidos</label><br>
              <input type="checkbox" id="p_bestseller" name="bestseller"/>
            </div>

            <div class="form-group <?= (in_array('new_product', $errorItems))?'has-error':'' ?>">
              <label for="p_new_product">Novo Produto</label><br>
              <input type="checkbox" id="p_new_product" name="new_product"/>
            </div>

            <hr>

            <?php foreach($option_list as $optionItem):?>
              <div class="form-group">
                <label for="p_option_<?=$optionItem['id']?>"><?=$optionItem['name']?></label>
                <input type="text" name="options[<?=$optionItem['id']?>]" id="p_option_<?=$optionItem['id']?>" value="" class="form-control">
              </div>
            <?php endforeach?>

            <hr>

            <label for="">Imagens do Produto</label><br>

            <button class="p_new_image btn btn-primary">+</button>

            <div class="products_files_area">
              <input type="file" name="images[]" style='margin-bottom:5px;'/>
            </div>

          </div>
        </div>

      </form>

</section>

<script src="https://cdn.tiny.cloud/1/07jlmfe1z337xdt19l41eq7ua2e7hat7fmtlwh8cbb3ddht3/tinymce/5/tinymce.min.js"></script>
<script type="text/javascript">
  tinymce.init({
    selector:'#p_description',
    height:200,
    menubar:false,
    plugins:[
      'textcolor image media lists'
    ],
    toolbar: 'undo redo | formatselect | bold italic backcolor | media image | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat',
    // automatic_uploads:true,
    // files_picker_types: 'image',
    // images_upload_url: '<?=BASE_URL?>products/upload'
  });
</script>
