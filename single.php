<?php get_header(); ?>

    <main id="blog-1md">
        <div class="container">
            <div class="row">
            
                <div id="posts" class="col-md single">
                    <?php
                        if(have_posts()){
                            while(have_posts()){
                               the_post(); ?>
                                    
                                <div class="item latest-news">
                                    <div class="row">
                                        <div class="col-12">
											
											<h3 class="single-title"><?php the_title(); ?></h3>
                                            
                                            <figure class="position-relative">												
												<img class="img-fluid" src="<?php the_post_thumbnail_url('medium'); ?>" alt="">
                                            </figure>
                                                                                        
                                        </div>
                                        <div id="single-post-content" class="col-12">
											<?php echo the_content(); ?>
                                        </div>
                                    </div>
                                </div>

                            <?php }
                        }
                    ?>

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
                                ?>
                                   
                                <?php ?>
                            </ol>
                        </div>
                        <div id="sidemenu-category" class="widget">
                            <h3>Categorias</h3>
                            <ol>
                                <?php
                                    //for each category, show all posts
                                    $cat_args = array(
                                    'orderby' => 'name',
                                    'order' => 'ASC'
                                    );
                                    $categories=get_categories($cat_args);
                                    foreach($categories as $category) {
                                        $args=array(
                                        'showposts' => -1,
                                        'category__in' => array($category->term_id),
                                        'caller_get_posts'=>1
                                        );
                                        echo '<li> <a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </li> ';
                                    }
                                ?>
                            </ol>   
                        </div>
                    </div>
                </div>                

            </div>
        </div>
    </main>



<?php get_footer(); ?>