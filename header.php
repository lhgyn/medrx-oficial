<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bloginfo(); ?></title>
    <!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-5N58KTZ');</script>

	<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>
<body <?php body_class()?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5N58KTZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    
<header id="site-header" style="position: relative">
	<?php if(!is_page('finalizar-compra')): ?>
	<nav id="site-navbar" class="navbar navbar-expand-lg navbar-light bg-light d-none d-lg-block">
	  <div class="container">
  		  <a class="navbar-brand" href="<?php echo home_url() ?>">
		    <img src="<?php echo get_template_directory_uri() ?>/images/logo4.png" alt="">
		  </a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <?php 
			  	wp_nav_menu( array(
					'theme_location'  => 'primary',
					'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
					'container'       => '',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'navbar-nav ml-auto',
					'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
					'walker'          => new WP_Bootstrap_Navwalker(),
				) );
 			?>
 			<ul class="navbar-nav nav-icons ml">
 				<li class="nav-item d-block d-sm-none">
 					<a class="nav-link" href="<?php echo home_url('/carrinho') ?>">MEU CARRINHO</a>
 				</li>
 				<li class="d-block d-sm-none">
 					<form action="">
		            	<div class="input-group input-group-sm mb-3">
						  <input type="text" name="s" class="form-control" placeholder="Faça uma busca" aria-label="Recipient's username" aria-describedby="button-addon2">
						  <div class="input-group-append">
						    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Pesquisar</button>
						  </div>
						</div>
		            </form>
		        </li>
 				<li class="nav-item dropdown  d-none d-lg-block">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          <i class="fas fa-sm fa-search"></i>
			        </a>
			        <div id="search-form" class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			            <form action="<?php echo home_url() ?>" method="GET">
			            	<div class="input-group input-group-sm">
							  <input type="text" name="s" class="form-control" placeholder="Faça uma busca" aria-label="Recipient's username" aria-describedby="button-addon2">
							  <div class="input-group-append">
							    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Pesquisar</button>
							  </div>
							</div>
			            </form>
			        </div>
			    </li>
 				<li class="nav-item dropdown  d-none d-lg-block">
 					 <a class="nav-link dropdown-toggle" href="#" id="navbarCart" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          <i class="fas fa-sm fa-shopping-cart"></i>
			        </a>
			        <span id="cart-qty" class="count-cart"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
			        <div id="header-cart" class="dropdown-menu" aria-labelledby="navbarCart">
			            <div class="card">
			            	<ul>
			            		<?php $items = WC()->cart->get_cart(); ?>
			            		<?php foreach($items as $k => $v): //print_r($v['data'])?>
			            		<li id="item-<?= $v['product_id'] ?>">
			            			<div id="cart-items">		            				
				            			<img src="<?php echo get_the_post_thumbnail_url( $v['product_id'], 'thumbnail' ) ?>" alt="">
				            			<div>				            				
					            			<p><?php echo $v['data']->name; ?></p>
					            			<p>R$ <?php echo $v['data']->sale_price ?
					            				number_format($v['data']->sale_price, 2, ',', '.') :
					            				number_format($v['data']->regular_price, 2, ',', '.'); ?>
					            			</p>
				            			</div>
				            			<div>
				            				<?php $key = $v['key']; ?>
				            				<a class="remove-item-cart" data-id="<?php echo $v['product_id'] ?>" href="">remover</a>
				            			</div>
				            		</div>
				            	</li>
				            	<?php endforeach; ?>

				            	<?php if($items): ?>
				            	<li class="cart-items">
				            		<div>
				            			<h5 class="text-center text-primary subtotal-text">
				            				Subtotal: <span id="cart-subtotal"><?php echo WC()->cart->get_total() ?></span>
				            			</h5>
				            		</div>
				            	</li>
				            	<li class="cart-items content-btn-cart">
				            		<a href="<?php echo home_url('/carrinho') ?>" class="btn btn-primary btn-block btn-view-cart">Ver Carrinho</a>
				            	</li>
				            	<li class="cart-items content-btn-checkout">
				            		<a href="<?php echo home_url('/finalizar-compra') ?>" class="btn btn-primary btn-block btn-view-checkout">Finalizar Compra <i class="fas fa-sm fa-arrow-right"></i></a>
				            	</li>
				            	<?php else: ?>
				            		<li class="empty-cart empty-cart-php">O carrinho está vazio</li>
				            	<?php endif; ?>
				            	<li class="empty-cart empty-cart-ajax" style="display: none">O carrinho está vazio</li>
			            	</ul>
			            </div>
			        </div>
			    </li>
 			</ul>
		  </div>
	  </div>
	</nav>

	<nav id="nav-mobile" class="d-block d-lg-none fixed-top">
	  <div class="pl-3 pr-3 pt-2 pb-2">
		  <div class="navbar-header">
		  	  <a id="toggle-mobile" href="#">
			    <i id="menu-closed" class="fas fa-bars"></i>
			    <i id="menu-opened" class="fas fa-times" style="display: none"></i>
			  </a>
			  <a class="navbar-brand" href="<?php echo home_url() ?>">
			  	<h1 class="d-none">MedRx</h1>
			  	<img src="<?php echo get_template_directory_uri() ?>/images/logo4.png" alt="">
			  	<!-- <span class="dashicons dashicons-cart"></span> -->
			  </a>
			  <a href="<?php echo home_url('/carrinho') ?>" class="cart-mobile" style="position:relative">
			  	<span id="cart-qty" class="count-cart"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
			  	<i class="fas fa-shopping-cart"></i>
			  </a>
		  </div>

		  <div class="mobile-collapse" style="display: none">
		  	
		  	<div class="mobile-search" style="padding-top: 25px;">
			  <form action="<?php echo home_url() ?>">
		  		<div class="input-group mb-3">
				  	  <input type="text" name="s" class="form-control" placeholder="Faça uma busca" aria-label="Recipient's username" aria-describedby="basic-addon2">
					  <div class="input-group-append">
					    <button class="btn btn-outline-secondary" type="submit">
					    	<span><i class="fa fa-search"></i></span>
					    </button>
					  </div>
				</div>
			  </form>
		  	</div>
		  	<?php 
			  	wp_nav_menu( array(
					'theme_location'  => 'primary',
					'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
					'container'       => '',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => '',
					'menu_id' 		  => 'mobile-dropdown',
					'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
					'walker'          => new WP_Bootstrap_Navwalker(),
				) );
 			?>
		  </div>
	  </div>
	</nav>



	<?php endif; ?>

	<?php if(is_page('finalizar-compra')): ?>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
	  			<div class="content-icon-checkout">
	  				<h4 class="icon-secure">
	  					<i class="fas fa-lock icon-lock"></i>
	  					CHECKOUT SEGURO
	  				</h4>
	  			</div>
	  			<div class="content-icon-loja">
	  				<img src="<?php echo get_template_directory_uri() ?>/images/logo4.png" width="90" alt="">
	  			</div>
		 	</div>
		 </nav>
	<?php endif; ?>
</header>