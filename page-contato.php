<?php get_header(); ?>

<main id="main-container">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3 class="text-center text-uppercase"><?php the_title(); ?></h3>
				<hr>
			</div>
			<div class="col-12">
				<?php echo do_shortcode( '[contact-form-7 id="390" title="Formulário de contato 1"]' ) ?>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>