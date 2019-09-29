<aside>
  <h1>Filtros</h1>
  <div class="filterarea">

    <form action="" method="GET">

          <input type="hidden" name="s" value="<?=$viewData['searchTerm']?>"/>
          <input type="hidden" name="category" value="<?=$viewData['category']?>"/>

          <div class="filterbox">
            <div class="filtertitle">Marcas</div>
            <div class="filtercontent">
              <?php if(!empty($viewData['filters']['brands'])):?>
                <?php foreach($viewData['filters']['brands'] as $brand):?>

                <?php if($brand['total'] > 0):?>
                  <div class="filteritem">
                    <input type="checkbox" <?php echo (isset($viewData['filters_selected']['brand']) && in_array($brand['id'], $viewData['filters_selected']['brand'])) ? 'checked="checked"' : '';?> name="filter[brand][]" value="<?=$brand['id']?>" id="filter_brand<?=$brand['id']?>" />
                    <label for="filter_brand"><?=$brand['name']?></label><span style="float:right;">(<?=$brand['total']?>)</span>
                  </div>
                <?php endif ?>

                <?php endforeach ?>
              <?php endif?>
            </div>
          </div>

          <div class="filterbox">
            <div class="filtertitle">Preço</div>
            <div class="filtercontent">

              <input type="hidden" id="slider0" name="filter[slider0]" value="<?=$viewData['filters']['slider0']?>"/>
              <input type="hidden" id="slider1" name="filter[slider1]" value="<?=$viewData['filters']['slider1']?>"/>
              <p><input type="text" id="amount" readonly></p>
              <div id="slider-range"></div>

            </div>
          </div>

          <div class="filterbox">
            <div class="filtertitle">Estrelas</div>
              <div class="filtercontent">

                <div class="filteritem">
                    <input type="checkbox" name="filter[star][]" value="0" <?php echo (isset($viewData['filters_selected']['star']) && in_array('0', $viewData['filters_selected']['star'])) ? 'checked="checked"' : '';?> id="filter_star0" />
                      <label for="filter_star0">
                        (Sem estrela)
                      </label>
                      <span style="float:right;">(<?=$viewData['filters']['stars']['0']?>)</span>
                </div>

                <div class="filteritem">
                    <input type="checkbox" name="filter[star][]" value="1" id="filter_star1" <?php echo (isset($viewData['filters_selected']['star']) && in_array('1', $viewData['filters_selected']['star'])) ? 'checked="checked"' : '';?> />
                      <label for="filter_star1">
                        <img src="<?=BASE_URL?>assets/images/star.png" border="0" height="13px">
                      </label>
                      <span style="float:right;">(<?=$viewData['filters']['stars']['1']?>)</span>
                </div>

                <div class="filteritem">
                    <input type="checkbox" name="filter[star][]" value="2" id="filter_star2" <?php echo (isset($viewData['filters_selected']['star']) && in_array('2', $viewData['filters_selected']['star'])) ? 'checked="checked"' : '';?>/>
                      <label for="filter_star2">
                        <img src="<?=BASE_URL?>assets/images/star.png" border="0" height="13px">
                        <img src="<?=BASE_URL?>assets/images/star.png" border="0" height="13px">
                      </label>
                      <span style="float:right;">(<?=$viewData['filters']['stars']['2']?>)</span>
                </div>

                <div class="filteritem">
                    <input type="checkbox" name="filter[star][]" value="3" id="filter_star3" <?php echo (isset($viewData['filters_selected']['star']) && in_array('3', $viewData['filters_selected']['star'])) ? 'checked="checked"' : '';?>/>
                      <label for="filter_star3">
                        <img src="<?=BASE_URL?>assets/images/star.png" border="0" height="13px">
                        <img src="<?=BASE_URL?>assets/images/star.png" border="0" height="13px">
                        <img src="<?=BASE_URL?>assets/images/star.png" border="0" height="13px">
                      </label>
                      <span style="float:right;">(<?=$viewData['filters']['stars']['3']?>)</span>
                </div>

                <div class="filteritem">
                    <input type="checkbox" name="filter[star][]" value="4" id="filter_star4" <?php echo (isset($viewData['filters_selected']['star']) && in_array('4', $viewData['filters_selected']['star'])) ? 'checked="checked"' : '';?>/>
                      <label for="filter_star4">
                        <img src="<?=BASE_URL?>assets/images/star.png" border="0" height="13px">
                        <img src="<?=BASE_URL?>assets/images/star.png" border="0" height="13px">
                        <img src="<?=BASE_URL?>assets/images/star.png" border="0" height="13px">
                        <img src="<?=BASE_URL?>assets/images/star.png" border="0" height="13px">
                      </label>
                      <span style="float:right;">(<?=$viewData['filters']['stars']['4']?>)</span>
                </div>

                <div class="filteritem">
                    <input type="checkbox" name="filter[star][]" value="5" id="filter_star5" <?php echo (isset($viewData['filters_selected']['star']) && in_array('5', $viewData['filters_selected']['star'])) ? 'checked="checked"' : '';?>/>
                      <label for="filter_star5">
                        <img src="<?=BASE_URL?>assets/images/star.png" border="0" height="13px">
                        <img src="<?=BASE_URL?>assets/images/star.png" border="0" height="13px">
                        <img src="<?=BASE_URL?>assets/images/star.png" border="0" height="13px">
                        <img src="<?=BASE_URL?>assets/images/star.png" border="0" height="13px">
                        <img src="<?=BASE_URL?>assets/images/star.png" border="0" height="13px">
                      </label>
                      <span style="float:right;">(<?=$viewData['filters']['stars']['5']?>)</span>
                </div>

              </div>
          </div>

          <div class="filterbox">
            <div class="filtertitle">Promoção</div>
              <div class="filtercontent">

                <div class="filteritem">
                    <input type="checkbox" name="filter[sale]" id="filter_sale" value="1" <?php echo (isset($viewData['filters_selected']['sale']) && $viewData['filters_selected']['sale'] == '1') ? 'checked="checked"' : '';?>>
                    <label for="filter_sale">Em promoção</label>
                    <span style="float:right;">(<?=$viewData['filters']['sale']?>)</span>
                </div>

              </div>
          </div>

          <!-- <div class="filterbox">
            <div class="filtertitle">Opções</div>
            <div class="filtercontent">

              <span style="float:right;">(<?=$viewData['filters']['options']?>)</span>

            </div>
          </div> -->

    </form>

  </div>

  <!-- <div class="widget">
    <h1>Featured Products</h1>
    <div class="widget_body">
      ...
    </div>
  </div> -->

</aside>
