<?php get_header(); ?>

<main id="main-container">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php if(!is_page('finalizar-compra'))
					echo '<h3 class="text-center text-uppercase">'.get_the_title().'</h3>';
				?>
				<hr>
			</div>
			<div class="col-12">
				<?php if(have_posts()): while(have_posts()): the_post(); ?>
						
					<?php the_content(); ?>

				<?php endwhile; endif; ?>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>