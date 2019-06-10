<div class="col">
	<aside id="sidebar">

		<div class="card">
			<div class="col title">
				<h4>Em Destaque!</h4>
			</div>
			<div class="col list">
				<ul>
					<li>
						<div class="image">
							<?php the_post_thumbnail( 'thumbnail', array('class'=>'img-fluid') ); ?>
						</div>
						<div class="text">
							<h6><?php the_title(); ?></h6>
						</div>
					</li>
					<li>
						<div class="image">
							<?php the_post_thumbnail( 'thumbnail', array('class'=>'img-fluid') ); ?>
						</div>
						<div class="text">
							<h6><?php the_title(); ?></h6>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="card">
			<div class="col title">
				<h4>Mais Lidos</h4>
			</div>
			<div class="col list">
				<ul>
					<li>
						<div class="image">
							<?php the_post_thumbnail( 'thumbnail', array('class'=>'img-fluid') ); ?>
						</div>
						<div class="text">
							<h6><?php the_title(); ?></h6>
						</div>
					</li>
					<li>
						<div class="image">
							<?php the_post_thumbnail( 'thumbnail', array('class'=>'img-fluid') ); ?>
						</div>
						<div class="text">
							<h6><?php the_title(); ?></h6>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="card">
			<div class="col title">
				<h4>Categorias</h4>
			</div>
			<div class="col list">
				<ul id="categories">
					
					<?php
						$categories = get_categories();
						foreach( $categories as $category ) {
						   echo '<li>
							   <a href="'
							   . get_category_link($category->term_id)
							   . '">' . $category->name .
							   '</a>
						   </li>';
						}
					?>
			
				</ul>
			</div>
		</div>

	</aside>
</div>