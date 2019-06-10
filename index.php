<?php get_header(); ?>

    <main id="blog-1md">
        <div class="container">
            <div class="row">
            
                <div id="posts" class="col-md">
                    <?php
                        $args = array('posts_type'=>'posts', 'posts_per_page'=>'3');
                        $latests = new WP_Query($args);
                        if($latests->have_posts()){
                            while($latests->have_posts()){
                                $latests->the_post(); ?>
                                    
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

                    <!-- /////////////////////////////////////////
                    ////////// ÚLTIMOS POSTS POR CATEGORIAS
                    //////////////////////// -->
                    
                    <?php $cats = get_categories(); ?>

                    <?php foreach($cats as $key => $cat) : ?>
                    <?php if( $cat->count >= 2 ) : ?>

                        <?php $args = array('post_type'=>'post', 'posts_per_page'=>2, 'cat'=>$cat->term_id); ?>
                        <?php $posts = new WP_Query($args); ?>
                        <?php if($posts->have_posts()) : ?>
                            <div id="post-categories" class="row">
                                <div class="col-12 title">
                                    <h3><?php echo $cat->name; ?></h3>
                                </div>                        
                                <div class="col-12 posts">
                                    <div class="row m-0">
                                        <?php while($posts->have_posts()) : ?>
                                        <?php $posts->the_post(); ?>
                                        
                                        <div class="item col-12 col-lg-6">
                                            <figure>
                                                <a href="<?php the_permalink(); ?>">
                                                    <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="">
                                                </a>
                                                <figcaption>
                                                    <?php
                                                    $categories = get_the_category();
                                                    if ( !empty( $categories ) ) {
                                                        echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
                                                    } ?>
                                                </figcaption>
                                            </figure>
                                            <h4><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4>
                                        </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php endif; ?>                           
                    <?php $increment++; endforeach; ?>

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