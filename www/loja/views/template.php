<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Loja Virtual</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

		<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?=BASE_URL; ?>assets/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="<?=BASE_URL; ?>assets/css/jquery-ui.min.css" type="text/css" />
    <link rel="stylesheet" href="<?=BASE_URL; ?>assets/css/jquery-ui.structure.css" type="text/css" />
    <link rel="stylesheet" href="<?=BASE_URL; ?>assets/css/jquery-ui.theme.css" type="text/css" />
    <link rel="stylesheet" href="<?=BASE_URL; ?>assets/css/style.css" type="text/css" />

	</head>
	<body>
		<nav class="navbar topnav">
			<div class="container">
				<ul class="nav navbar-nav">
					<li class="active"><a href="<?=BASE_URL; ?>">Home</a></li>
					<!-- <li><a href="<?=BASE_URL; ?>contact">Contato</a></li> -->
					<li><a href="http://localhost:8001/painel/">Admin</a></li>
					<!-- <li><a href="http://localhost:8001/novo-painel/">Novo Painel</a></li> -->
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
					<!-- <li><a href="<?=BASE_URL; ?>login">Login</a></li> -->
				</ul>
			</div>
		</nav>
		<header>
			<div class="container">
				<div class="row">
					<div class="col-sm-2 logo">
						<a href="<?=BASE_URL; ?>"><img src="<?=BASE_URL; ?>assets/images/logo.png" /></a>
					</div>
					<div class="col-sm-7">
						<div class="head_help">(11) 9999-9999</div>
						<div class="head_email">contato@<span>loja2.com.br</span></div>

						<div class="search_area">

							<form method="GET" action="<?=BASE_URL?>search">
 								<input type="text" name="s" required placeholder="Procure um item" autocomplete="off" value="<?=(!empty($viewData['searchTerm'])) ? $viewData['searchTerm'] : ''?>"/>
								<select name="category">
                  <option value="">Todas as Categorias</option>

                  <?php foreach($viewData['categories'] as $cat):?>

                    <option value="<?=$cat['id']?>" <?=($viewData['category'] == $cat['id']) ? 'selected="selected"': ''?> ><?=$cat['name']?></option>

                    <?php
                      if(count($cat['subs']) > 0){
                        $this->loadView('search_subcategory', array(
                          'subs'     => $cat['subs'],
                          'level'    => 1,
                          'category' => $viewData['category']
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
						<a href="<?=BASE_URL; ?>cart">
							<div class="cartarea">
								<div class="carticon">
									<div class="cartqt"><?=$viewData['cart_qt']?></div>
								</div>
								<div class="carttotal">
									Seu Carrinho:<br/>
									<span>R$ <?=number_format($viewData['cart_subtotal'], 2, ',', '.')?></span>
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

          <?php if(isset($viewData['sidebar'])):?>
            <div class="col-sm-3">
              <?php $this->loadView('sidebar', array('viewData'=>$viewData)) ?>
            </div>
            <div class="col-sm-9"><?php $this->loadViewInTemplate($viewName, $viewData); ?></div>
          <?php else:?>
            <div class="col-sm-1"></div>
            <div class="col-sm-10"><?php $this->loadViewInTemplate($viewName, $viewData); ?></div>
            <div class="col-sm-1"></div>
          <?php endif?>


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
							<a href="<?=BASE_URL; ?>"><img width="150" src="<?=BASE_URL; ?>assets/images/logo.png" /></a><br/><br/>
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
								<img src="<?=BASE_URL; ?>assets/images/visa.png" />
								<img src="<?=BASE_URL; ?>assets/images/visa.png" />
								<img src="<?=BASE_URL; ?>assets/images/visa.png" />
								<img src="<?=BASE_URL; ?>assets/images/visa.png" />
							</div>
						</div>
					</div>
	    		</div>
	    	</div>
      </footer>
    <script type="text/javascript">
      var BASE_URL     = '<?=BASE_URL; ?>';
      <?php if(isset($viewData['filters'])):?>
        var maxSlider    = <?=$viewData['filters']['maxSlider']?>;
      <?php endif?>
      // var sliderValues = [0, maxSlider];
    </script>
    <script type="text/javascript" src="<?=BASE_URL; ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=BASE_URL; ?>assets/js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?=BASE_URL; ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=BASE_URL; ?>assets/js/script.js"></script>
	</body>
</html>
