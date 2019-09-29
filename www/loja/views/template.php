<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Loja Virtual</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" type="text/css" />

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/jquery-ui.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/jquery-ui.structure.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/jquery-ui.theme.css" type="text/css" />

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css" type="text/css" />

	</head>
	<body>
		<nav class="navbar topnav">
			<div class="container">
				<ul class="nav navbar-nav">
					<li class="active"><a href="<?php echo BASE_URL; ?>">Home</a></li>
					<li><a href="<?php echo BASE_URL; ?>contact">Contato</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Inglês
						<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Inglês</a></li>
							<li><a href="#">Português</a></li>
							<li><a href="#">Espanhol</a></li>
						</ul>
					</li>
					<li><a href="<?php echo BASE_URL; ?>login">Login</a></li>
				</ul>
			</div>
		</nav>
		<header>
			<div class="container">
				<div class="row">
					<div class="col-sm-2 logo">
						<a href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL; ?>assets/images/logo.png" /></a>
					</div>
					<div class="col-sm-7">
						<div class="head_help">(11) 9999-9999</div>
						<div class="head_email">contato@<span>loja2.com.br</span></div>

						<div class="search_area">
							<form method="GET" action="<?=BASE_URL?>search">
								<input type="text" name="s" required placeholder="Procure um item" autocomplete="off"/>
								<select name="category">
                  <option value="">Todas as Categorias</option>

                  <?php foreach($viewData['categories'] as $cat):?>

                    <option value="<?=$cat['id']?>"><?=$cat['name']?></option>

                    <?php
                      if(count($cat['subs']) > 0){
                        $this->loadView('search_subcategory', array(
                          'subs'  => $cat['subs'],
                          'level' => 1
                        ));

                      }
                    ?>

                  <?php endforeach ?>

								</select>
								<input type="submit" value=""/>
						    </form>
						</div>
					</div>
					<div class="col-sm-3">
						<a href="<?php echo BASE_URL; ?>cart">
							<div class="cartarea">
								<div class="carticon">
									<div class="cartqt">0</div>
								</div>
								<div class="carttotal">
									Seu Carrinho:<br/>
									<span>R$ 000,00</span>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</header>
		<div class="categoryarea">
			<nav class="navbar">
				<div class="container">
					<ul class="nav navbar-nav">
						<li class="dropdown">
					        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Selecione Uma Categoria
					        <span class="caret"></span></a>
					        <ul class="dropdown-menu">


                      <?php foreach($viewData['categories'] as $cat):?>

                        <li>
                          <a href="<?=BASE_URL?>categories/enter/<?=$cat['id']?>">
                            <?=$cat['name']?>
                          </a>
                        </li>

                        <?php

                          if(count($cat['subs']) > 0){

                            $this->loadView('menu_subcategory', array(
                              'subs'  => $cat['subs'],
                              'level' => 1
                            ));

                          }
                        ?>
                      <?php endforeach ?>

					        </ul>
					      </li>

                <?php if(isset($viewData['categories_filter'])):?>

                  <?php foreach($viewData['categories_filter'] as $cf):?>

                    <li><a href="<?=BASE_URL?>categories/enter/<?=$cf['id']?>"><?=$cf['name']?></a></li>

                  <?php endforeach?>

                <?php endif?>

					</ul>
				</div>
			</nav>
		</div>
		<section>
			<div class="container">
				<div class="row">
				  <div class="col-sm-3">
				  	<aside>
				  		<h1>Filtros</h1>
				  		<div class="filterarea">

                <form action="" method="GET">

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
				  </div>
				  <div class="col-sm-9"><?php $this->loadViewInTemplate($viewName, $viewData); ?></div>
				</div>
	    	</div>
	    </section>
	    <footer>
	    	<div class="container">
	    		<div class="row">
				  <div class="col-sm-4">
				  	<div class="widget">
			  			<h1>Featured Products</h1>
			  			<div class="widget_body">
			  				...
			  			</div>
			  		</div>
				  </div>
				  <div class="col-sm-4">
				  	<div class="widget">
			  			<h1>On-Sale Products</h1>
			  			<div class="widget_body">
			  				...
			  			</div>
			  		</div>
				  </div>
				  <div class="col-sm-4">
				  	<div class="widget">
			  			<h1>Top Rated Products</h1>
			  			<div class="widget_body">
			  				...
			  			</div>
			  		</div>
				  </div>
				</div>
	    	</div>
	    	<div class="subarea">
	    		<div class="container">
	    			<div class="row">
						<div class="col-xs-12 col-sm-8 col-sm-offset-2 no-padding">
							<form method="POST">
                  <input class="subemail" name="email" placeholder="Subscribe to our newsletter">
                  <input type="submit" value="Subscribe" />
              </form>
						</div>
					</div>
	    		</div>
	    	</div>
	    	<div class="links">
	    		<div class="container">
	    			<div class="row">
						<div class="col-sm-4">
							<a href="<?php echo BASE_URL; ?>"><img width="150" src="<?php echo BASE_URL; ?>assets/images/logo.png" /></a><br/><br/>
							<strong>Slogan da Loja Virtual</strong><br/><br/>
							Endereço da Loja Virtual
						</div>
						<div class="col-sm-8 linkgroups">
							<div class="row">
								<div class="col-sm-4">
									<h3>Categorias</h3>
									<ul>
										<li><a href="#">Categoria X</a></li>
										<li><a href="#">Categoria X</a></li>
										<li><a href="#">Categoria X</a></li>
										<li><a href="#">Categoria X</a></li>
										<li><a href="#">Categoria X</a></li>
										<li><a href="#">Categoria X</a></li>
									</ul>
								</div>
								<div class="col-sm-4">
									<h3>Information</h3>
									<ul>
										<li><a href="#">Menu 1</a></li>
										<li><a href="#">Menu 2</a></li>
										<li><a href="#">Menu 3</a></li>
										<li><a href="#">Menu 4</a></li>
										<li><a href="#">Menu 5</a></li>
										<li><a href="#">Menu 6</a></li>
									</ul>
								</div>
								<div class="col-sm-4">
									<h3>Information</h3>
									<ul>
										<li><a href="#">Menu 1</a></li>
										<li><a href="#">Menu 2</a></li>
										<li><a href="#">Menu 3</a></li>
										<li><a href="#">Menu 4</a></li>
										<li><a href="#">Menu 5</a></li>
										<li><a href="#">Menu 6</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
	    		</div>
	    	</div>
	    	<div class="copyright">
	    		<div class="container">
	    			<div class="row">
						<div class="col-sm-6">© <span>Loja Virtual</span> - Todos os direitos reservados.</div>
						<div class="col-sm-6">
							<div class="payments">
								<img src="<?php echo BASE_URL; ?>assets/images/visa.png" />
								<img src="<?php echo BASE_URL; ?>assets/images/visa.png" />
								<img src="<?php echo BASE_URL; ?>assets/images/visa.png" />
								<img src="<?php echo BASE_URL; ?>assets/images/visa.png" />
							</div>
						</div>
					</div>
	    		</div>
	    	</div>
      </footer>
    <script type="text/javascript">
      var BASE_URL     = '<?php echo BASE_URL; ?>';
      var maxSlider    = <?=$viewData['filters']['maxSlider']?>;
      // var sliderValues = [0, maxSlider];
    </script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
	</body>
</html>
