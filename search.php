<?php get_header(); ?>

<main id="main-container">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h5>sua busca por: <strong style="color:#7bcbbf"><?php echo $_GET['s']; ?></strong></h5>
				<hr>
			</div>

			<?php if( have_posts() ): ?>
					<?php while( have_posts() ): the_post();
						$posts[] = array(
							'ID' => get_the_ID(),
							'title' => get_the_title(),
							'excerpt' => get_the_excerpt(),
							'content' => get_the_content(),
							'thumbnail' => get_the_post_thumbnail_url( $post = null, $size = 'large' ),
							'permalink' => get_the_permalink()
						);
					endwhile;			
				endif;
				foreach ($posts as $key => $value) {
					if($value->post_type == 'product')
						$products[] = $value;
					elseif($value->post_type == 'post')
						$articles[] = $value;
				};
			?>

			<?php if($products): ?>
			<div class="col-12 woocommerce">
				<!-- <div class="container"> -->
					<div class="row">
						<?php foreach ($products as $key => $value) { ?>
		            		<div class="col-xd col-sm-6 col-md-4 col-lg-3 box-product-search">
		            			<div class="content-best-products" id="content-best-saller">
									<div class="content-product-home">
		                                <a href="/produto/<?=$value->post_name?>" >
		                                    <?php echo get_the_post_thumbnail($value->ID, 'large', ['class'=>'img-fluid']); ?>
		                                    <h2 class="woocommerce-loop-product__title titulo title-product-home" style=""><?=$value->post_title?></h2>
		                                </a>
		                                <div class="detalhes"><?=$value->post_excerpt?></div>
		                                <?php get_star_rating( get_field('rating_star', $value->ID ) ); ?>
		                                <a class="btn btn-default read-more" href="/produto/<?=$value->post_name?>">Saiba Mais</a>
		                                <?php  ?>
		                            </div>
			                    </div>
		            		</div>
		            	<?php } ?>
		            <!-- </div>            		 -->
            	</div>
			</div>
            <?php endif; ?>

			<?php if($articles) : ?>
				<?php //print_r($articles); ?>
				<div class="col-12 mt-5">
				<div class="row">		
					<?php foreach ($articles as $key => $value) { ?>
						<div class="col-12 pb-3">
							<div class="row">
								<div class="col-sm-12 col-md-4">
									<?=get_the_post_thumbnail($value->ID, 'medium', ['class'=>'img-fluid', 'style'=>'width:100%;height:220px;object-fit:cover']); ?>
								</div>
								<div class="col-sm-12 col-md-8">
									<h4 class="text-secondary"><?=$value->post_title?></h4>
									<p><?=wp_trim_words( $value->post_content )?></p>								
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
				</div>
			<?php endif; ?>
				
			<?php if(!$products && !$articles): ?>
				<div class="col-md-12">
					
					<div class="card p-4">
						
						<h5 class="text-center">Desculpe, sua busca não obteve resultados.
							<br><br><small>tente pesquisar por um termo diferente.</small>
						</h5>

					</div>

				</div>
			<?php endif; ?>

		</div>
	</div>
</main>

<?php get_footer() ?>