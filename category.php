<?php get_header(); ?>

    <main id="blog-1md">
        <div class="container">
            <div class="row">
            
                <div id="posts" class="col-md">
                    <?php
                        if(have_posts()){
                            while(have_posts()){
                                the_post(); ?>
                                    
                                <div class="item latest-news">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            
                                            <figure class="position-relative">
                                                <a href="<?php the_permalink() ?>">
                                                    <img class="img-fluid" src="<?php the_post_thumbnail_url('medium'); ?>" alt="">
                                                </a>
                                                <figcaption>
                                                    <?php
                                                    $categories = get_the_category();
                                                    if ( !empty( $categories ) ) {
                                                        echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
                                                    } ?>
                                                </figcaption>
                                            </figure>
                                                                                        
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div>
                                                <h3><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h3>
                                                <p><a href="<?php the_permalink(); ?>"><?php echo get_excerpt(120); ?></a></p>
                                                <a class="link" href="<?php the_permalink(); ?>">LEIA MAIS</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php }
                        }
					?> 
					<div class="">
					<?php
						if ( function_exists('wp_bootstrap_pagination') )
							wp_bootstrap_pagination();
					?>
					</div>                  

                </div>

                <div id="blog-sidebar" class="col-lg-4 col-md-12">
                    <div id="sidebar" class="sidebar">
                        <div id="more-read" class="widget">
                            <h3>Mais Lidos</h3>
                            <ol>
                                <?php
                                    $args = array(
                                        'post_type'=>'post',
                                        'posts_per_page'=>5,
                                        'orderby' => 'meta_value_num',
                                        'meta_key' => 'medrx_post_views_count'
                                    );
                                    $more_reads = new WP_Query($args);
                                    if($more_reads->have_posts()){
                                        while($more_reads->have_posts()){
                                            $more_reads->the_post(); ?>

                                            <li>
                                                <a href="<?php the_permalink(); ?>">
                                                    <figure><img class="img-fluid" src="<?php the_post_thumbnail_url('thumbnail'); ?>" alt=""></figure>
                                                    <p><?php the_title(); ?></p>
                                                </a>
                                            </li>

                                        <?php }
									}
									wp_reset_postdata();
                                ?>
                                   
                                <?php ?>
                            </ol>
                        </div>
                        <div id="sidemenu-category" class="widget">
							<h3>Categorias</h3>
							<?php $current_cat = get_category(get_query_var('cat')); //print_r($current_cat) ?>
                            <ol>
                                <?php
                                    //for each category, show all posts
                                    $cat_args = array(
                                    'orderby' => 'name',
                                    'order' => 'ASC'
                                    );
                                    $categories = get_categories($cat_args);
                                    foreach($categories as $cat) {
                                        $args=array(
                                        'showposts' => -1,
                                        'category__in' => array($cat->term_id),
                                        'caller_get_posts'=>1
                                        ); ?>
                                        <li class="<?php echo $cat->term_id == $current_cat->term_id ? 'cat-active' : 'no-active'; ?>">
											<a href="<?=get_category_link( $cat->term_id )?>" title="<?php echo sprintf( __( "View all posts in %s" ), $cat->name );?>"><?php echo $cat->name;?></a>
										</li>
                                    <?php }
                                ?>
                            </ol>   
                        </div>
                    </div>
                </div>                

            </div>
        </div>
    </main>



<?php get_footer(); ?>