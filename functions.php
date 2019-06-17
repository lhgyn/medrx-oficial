<?php

function get_excerpt($count){
  $permalink = get_permalink($post->ID);
  $excerpt = get_the_excerpt();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = $excerpt.'  [...]';
  return $excerpt;
}

/*///////////////////////////////////////////////
////////// WORDPRESS DEFAULT SETTINGS
////////////////////////////*/
show_admin_bar(false);
add_theme_support('post-thumbnails');
add_theme_support('menus');
add_theme_support('woocommerce', array(
    'thumbnail_image_width' => 300,
    'gallery_thumbnail_image_width' => 200,
    'single_image_width' => 450,
    )
);
add_theme_support('html5', array(
'search-form',
'comment-form',
'comment-list',
'gallery',
'caption',
));



/*///////////////////////////////////////////////
////////// IMPORT DE LIBS
////////////////////////////*/
// Register Custom Navigation Walker
require_once('includes/wp_bootstrap_navwalker.php');
// Register Custom Navigation Walker
require_once('includes/wp_bootstrap_pagination.php');


/*///////////////////////////////////////////////
////////// LOAD DE SCRIPTS
////////////////////////////*/
function medrx_scripts()
{   
    //////////////////////////////////
    // SCRIPTS FOR DEVELOPMENT
    //////////////////////////////////
    // wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js');
    // wp_enqueue_script('bootstrap4', get_template_directory_uri() . '/assets/libs/bootstrap4/js/bootstrap.min.js');
    // wp_enqueue_script('inputmask', get_template_directory_uri() . '/assets/libs/inputmask/jquery.mask.min.js');
    // wp_enqueue_script('owlcarousel', get_template_directory_uri() . '/assets/libs/owl-carousel/owl.carousel.min.js');
    // wp_enqueue_script('fontawesome', get_template_directory_uri() . '/assets/libs/font-awesome5/js/all.min.js');
    // wp_enqueue_script('custom', get_template_directory_uri() . '/assets/js/custom.js');
    // wp_enqueue_script('products', get_template_directory_uri() . '/assets/js/products.js');
    // wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js');

    //////////////////////////////////
    // ALL SCRIPTS FOR PRODUCTION
    //////////////////////////////////
    wp_enqueue_script('__all-scripts', get_template_directory_uri() . '/assets/js/__all-scripts.min.js');

    //////////////////////////////////
    // STYLES FOR DEVELOPMENT
    //////////////////////////////////
    wp_enqueue_style('_styles', get_template_directory_uri() . '/assets/css/_styles.css');

    //////////////////////////////////
    // ALL STYLES FOR PRODUCTION
    //////////////////////////////////
    //wp_enqueue_style('__all-styles', get_template_directory_uri() . '/assets/css/__all-styles.min.css');
    wp_enqueue_style('theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'medrx_scripts');



/*///////////////////////////////////////////////
////////// REGISTRA OS MENUS DO SITE
////////////////////////////*/
register_nav_menus(array(
    'primary' => __('Principal', 'medrx'),
    'footer-left' => __('MedRx', 'medrx'),
    'footer-center-left' => __('Empresa', 'medrx'),
    'footer-center-right' => __('Atendimento', 'medrx'),    
    'footer-right' => __('Informações', 'medrx')
));


/*///////////////////////////////////////////////
////////// REGISTRA OS WIDGETS
////////////////////////////*/
function footer_widgets_init() {
    register_sidebar( array(
    'name'          => esc_html__( 'Loja 1', 'medrx' ),
    'id'            => 'loja-1',
    'description'   => esc_html__( 'Menu Institucional', 'medrx' ),
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar loja', 'medrx' ),
    'id'            => 'loja',
    'description'   => esc_html__( 'Sidebar loja', 'medrx' ),
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );
  register_sidebar( array(
    'name'          => esc_html__( 'Footer MedRx', 'medrx' ),
    'id'            => 'footer-1',
    'description'   => esc_html__( 'Menu Institucional', 'medrx' ),
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );
  register_sidebar( array(
    'name'          => esc_html__( 'Footer Empresa', 'medrx' ),
    'id'            => 'footer-2',
    'description'   => esc_html__( 'Menu de empresa', 'medrx' ),
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
  register_sidebar( array(
    'name'          => esc_html__( 'Footer Atendimento', 'medrx' ),
    'id'            => 'footer-3',
    'description'   => esc_html__( 'Menu de atendimento', 'medrx' ),
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
  register_sidebar( array(
    'name'          => esc_html__( 'Footer Informações', 'medrx' ),
    'id'            => 'footer-4',
    'description'   => esc_html__( 'Menu de informações', 'medrx' ),
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'footer_widgets_init' );


/*///////////////////////////////////////////////
////////// CLASSIFICAÇÃO ESTRELAS DOS PRODUTOS
////////////////////////////*/
function get_star_rating($val)
{
    echo '<hr/><div class="star-rating stars-loja" ><span class="verificar-star" style="width:'.( ( $val / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$val.'</strong> '.__( 'coisa/5', 'woocommerce' ).'</span></div>'.'<div class="nota-estrela"> <span>'.$val.'/5</span></div>';
}






// add_filter( 'woocommerce_billing_fields', 'wc_optional_billing_fields', 10, 1 );
// function wc_optional_billing_fields( $address_fields ) {
// $address_fields['billing_number']['required'] = false;
// return $address_fields;
// }

// add_filter( 'woocommerce_shipping_fields', 'wc_optional_shipping_fields', 10, 1 );
// function wc_optional_shipping_fields( $address_fields ) {
// $address_fields['shipping_number']['required'] = false;
// return $address_fields;
// }


/*///////////////////////////////////////////////
////////// DEFININDO VARIAÇÃO DO PRODUTO
////////////////////////////*/
function get_product_regular_price($variation_id) {
    global $woocommerce; 
    $product = new WC_Product_Variation($variation_id);
    return $product->get_regular_price(); 
}
function get_product_min_price($variation_id) {
    global $woocommerce; 
    $product = new WC_Product_Variation($variation_id);
    return $product->get_price(); 
}
function get_product_descricao($variation_id) {
    global $woocommerce; 
    $product = new WC_Product_Variation($variation_id);
    return $product->get_variation_attributes(); 
}
function get_product_ref($variation_id) {
    global $woocommerce; 
    $product = new WC_Product_Variation($variation_id);
    return $product->get_description(); 
}

//ADICONA NOVAS TABS
add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {
    
    // Adds the new tab
    
    $tabs['nossa_promessa'] = array(
        'title'     => __( 'Nossa Promessa', 'woocommerce' ),
        'priority'  => 10,
        'callback'  => 'woo_new_product_tab_nossa_promessa'
    );
    $tabs['perguntas_frequentes'] = array(
        'title'     => __( 'Perguntas Frequentes', 'woocommerce' ),
        'priority'  => 15,
        'callback'  => 'woo_new_product_tab_perguntas_frequentes'
    );
    $tabs['referencias_clinicas'] = array(
        'title'     => __( 'Referências Clínicas', 'woocommerce' ),
        'priority'  => 20,
        'callback'  => 'woo_new_product_tab_referencias_clinicas'
    );
    
    return $tabs;

}

function woo_new_product_tab_nossa_promessa()  {
    // The new tab content
    $prod_id = get_the_ID();
    echo'<p>'.get_post_meta($prod_id,'nossa_promessa',true).'</p>';
    //echo get_the_field('nossa_promessa',508);
}
function woo_new_product_tab_perguntas_frequentes()  {
    // The new tab content
    $prod_id = get_the_ID();
    echo'<p>'.get_post_meta($prod_id,'perguntas_frequentes',true).'</p>';
    //the_field('perguntas_frequentes');
}
function woo_new_product_tab_referencias_clinicas()  {
    // The new tab content
    $prod_id = get_the_ID();
    echo'<p>'.get_post_meta($prod_id,'referencias_clinicas',true).'</p>';
}

// // REMOVE TABS DA PAGINA SIMPLES DO PRODUTO.
// function woo_remove_product_tabs( $tabs ) {
//     unset( $tabs['description'] );          // Remove the description tab
//     unset( $tabs['reviews'] );          // Remove the reviews tab
//     unset( $tabs['additional_information'] );   // Remove the additional information tab
//     return $tabs;
// }
// add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

//REMOVE TABS
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] );          // Remove the additional information tab
    return $tabs;
}
//RENOMEANDO TABS
add_filter( 'woocommerce_product_tabs', 'wp_woo_rename_reviews_tab', 98);
function wp_woo_rename_reviews_tab($tabs) {
    
    $tabs['reviews']['title'] = 'Avaliações';
    
    return $tabs;
}
//PRIORIDADE TABS DEFAULT
add_filter( 'woocommerce_product_tabs', 'woo_reorder_tabs', 98 );
function woo_reorder_tabs( $tabs ) {
    $tabs['description']['priority'] = 1;           // Description first
    $tabs['reviews']['priority'] = 2;   // Additional information second
    return $tabs;
}



// REDIRECIONA CART PARA CHECKOUT
function bbloomer_redirect_checkout_add_cart( $url ) {
    $url = get_permalink( get_option( 'woocommerce_checkout_page_id' ) ); 
    return $url;
} 
add_filter( 'woocommerce_add_to_cart_redirect', 'bbloomer_redirect_checkout_add_cart' );

// REMOVE O AVISO VERDE PRODUTO ADD NO CARRINHO
add_filter( 'wc_add_to_cart_message_html', '__return_null' );

// REMOVE O ALERTA DE CUPOM
add_action( 'woocommerce_before_checkout_form', 'remove_checkout_coupon_form', 9 );
function remove_checkout_coupon_form(){
    remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
}


//Removendo alguns itens do sumário da pagina do produto (Nome do produto, Preço do produto e Referencia do produto)
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

 
//Função que adiciona o conteudo adicionado via Painel adm na função '@woocommerce_single_product_summary' do Woocommerce
function custom_summary( ) { 
    $prod_id = get_the_ID();
    echo'<hr/>'.get_post_meta($prod_id,'beneficios',true);
};     
add_action( 'woocommerce_single_product_summary', 'custom_summary', 40 ); 

// REMOVE TODAS AS OPÇÕES DE PRODUTOS, MENOS OPÇÃO VARIAVEL
add_filter( 'product_type_selector', 'remove_product_types' );
function remove_product_types( $types ){
    unset( $types['grouped'] );
    unset( $types['external'] );
    unset( $types['simple'] );

    return $types;
}

/*///////////////////////////////////////////////
////////// WORDPRESS LOGIN
////////////////////////////*/

function custom_login_css()
{
    echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/css/wp-login.css"/>';
}
add_action('login_head', 'custom_login_css');

//Função que altera a URL, trocando pelo endereço do seu site
function my_login_logo_url()
{
    return get_bloginfo('url');
}
add_filter('login_headerurl', 'my_login_logo_url');

//Função que adiciona o nome do seu site, no momento que o mouse passa por cima da logo
function my_login_logo_url_title()
{
    return 'Nome do seu site - Voltar para Home';
}
add_filter('login_headertitle', 'my_login_logo_url_title');


// REMOVER FIELDS DESNECESSARIOS DO ONE PAGE CHECKOUT
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
    unset($fields['order']['order_comments']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_country']);
    unset($fields['shipping']['shipping_company']);
    unset($fields['shipping']['shipping_country']);

    return $fields;
}


add_filter( 'woocommerce_update_order_review_fragments', 'my_custom_shipping_table_update');

function my_custom_shipping_table_update( $fragments ) {
    
     
    ob_start();
    ?>
    <table class="my-custom-shipping-table">
        <tbody>

        <?php wc_cart_totals_shipping_html(); ?>
        </tbody>
    </table>
    <?php
    $woocommerce_shipping_methods = ob_get_clean();

    $fragments['.my-custom-shipping-table'] = $woocommerce_shipping_methods;
    

    return $fragments;
}

/*///////////////////////////////////////////////
////////// WIDGET LISTA OS PRODUTOS CADASTRADOS
////////////////////////////*/

function list_product_register_widget() {
    register_widget( 'list_product_widget' );
}

add_action( 'widgets_init', 'list_product_register_widget' );

class list_product_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            // widget ID
            'list_product_widget',
            // widget name
            __('Produtos MedRx', ' list_product_widget_domain'),
            // widget description
            array( 'description' => __( 'Listar os produtos MedRx', 'list_product_widget_domain' ), )
        );
    }
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        echo $args['before_widget'];
        //if title is present
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        //output
        $query = new WP_Query( array(
            'posts_per_page' => -1,
            'post_type' => 'product',
            'post_status' => 'publish',
            'hide_empty' => 0,
            'orderby' => 'title',
        ) );

        $output = '<ul>';

        while ( $query->have_posts() ) : $query->the_post();
            $output .= '<li><a href="'. get_permalink( $query->post) . '">' . $query->post->post_title . '</a></li>';
        endwhile;
        wp_reset_postdata();

        echo $output.'</ul>';
        // echo get_custom_product_list();
        // echo __( 'Hello, World from Hostinger.com', 'list_product_widget_domain' );
        echo $args['after_widget'];
    }
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) )
            $title = $instance[ 'title' ];
        else
            $title = __( 'Nossos Produtos', 'list_product_widget_domain' );
            ?>
            <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
        <?php
    }
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }

}


/**
 * Registers a new post type
 * @uses $wp_post_types Inserts new post type object into the list
 *
 * @param string  Post type key, must not exceed 20 characters
 * @param array|string  See optional args description above.
 * @return object|WP_Error the registered post type object, or an error object
 */
function product_warnme() {

    $labels = array(
        'name'               => __( 'Avise-me', 'medrx' ),
        'singular_name'      => __( 'Avise-me', 'medrx' ),
        'add_new'            => _x( 'Adicionar Novo', 'medrx', 'medrx' ),
        'add_new_item'       => __( 'Adicionar Novo', 'medrx' ),
        'edit_item'          => __( 'Editar', 'medrx' ),
        'new_item'           => __( 'Novo', 'medrx' ),
        'view_item'          => __( 'Ver', 'medrx' ),
        'search_items'       => __( 'Buscar', 'medrx' ),
        'not_found'          => __( 'Não Encontrado', 'medrx' ),
        'not_found_in_trash' => __( 'Nada Apagado', 'medrx' ),
        'parent_item_colon'  => __( 'Ascendente:', 'medrx' ),
        'menu_name'          => __( 'Avise-me Produto', 'medrx' ),
    );

    $args = array(
        'labels'              => $labels,
        'hierarchical'        => false,
        'description'         => 'description',
        'taxonomies'          => array(),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => false,
        'menu_position'       => null,
        'menu_icon'           => null,
        'show_in_nav_menus'   => false,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => true,
        'capability_type'     => 'post',
        'supports'            => array(
            'title',
            'editor',
            'author',
            'custom-fields'
        ),
    );

    register_post_type( 'aviseme', $args );
}
add_action( 'init', 'product_warnme' );


////////////////////////////////////////////////////
// Scheduled Action Hook
// Avisa o cliente quando um produto volta ao estoque.
///////////////////////////////////////
function avisar_produto_disponivel() {

    $args = array(
        'post_type'=>'aviseme',
        'meta_key' => '_notified',
        'meta_value' => 0,
        'meta_compare' => '='
    );
    $query = new WP_Query($args);
    $posts = $query->posts;

    foreach ($posts as $key => $value) {
        $data = (object) unserialize($value->post_content); 
        $to = $data->email;
        $subject = $data->subject;
        $body = '<!DOCTYPE html><html><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible"content="IE=edge"><title>MedRx Nutraceutikos</title><link rel="stylesheet"href=""><link href="https://fonts.googleapis.com/css?family=Rubik:400,500,700"rel="stylesheet"></head><body style="font-family:Rubik,sans-serif"><div style="display:block;margin:0 auto;max-width:750px;padding-top:15px"><header style="background:#ccc;padding-top:25px;padding-bottom:25px"><h1 style="text-align:center"><img src="https://medrx.com.br/wp-content/themes/medrx/images/logo4.png"alt="MedRx"style="max-width:100px"></h1></header><main><div><div style="text-align:center"><h4>Olá '.$data->name.'</h4><p>O produto que você quer chegou em nosso estoque.</p><p>Corre lá para garantir o seu antes que acabe outra vez.</p></div><div style="text-align:center"><a href="'.$data->product_link.'"><img src="'.$data->product_image.'" alt="'.$data->product_name.'"style="margin:0 auto;max-width:300px"></a></div><div style="text-align:center;margin-top:25px;margin-bottom:50px"><a href="'.$data->product_link.'"style="text-decoration:none;color:#fff;background:#ff8c00;padding:10px 45px;border-radius:10px;border-bottom:3px solid #b8860b;font-size:26px">COMPRAR</a></div></div><hr><div style="display:block;width:100%;" align="center"><ul style="list-style:none;margin:0 auto;padding:0;width:auto;display:inline-block;"><li style="display:inline-block;margin:0;padding:10px"><img src="https://medrx.com.br/wp-content/themes/medrx/images/selo-satisfacao2.png"alt="Selos MedRx"style="max-width:60px"></li><li style="display:inline-block;margin:0;padding:10px"><img src="https://medrx.com.br/wp-content/themes/medrx/images/lock-cert3.png"alt="Selos MedRx"style="max-width:60px"></li><li style="display:inline-block;margin:0;padding:10px"><img src="https://medrx.com.br/wp-content/themes/medrx/images/logo-pagarme-1.png"alt="Selos MedRx"style="max-width:60px"></li><li style="display:inline-block;margin:0;padding:10px"><img src="https://medrx.com.br/wp-content/themes/medrx/images/selo-card.png"alt="Selos MedRx"style="max-width:60px"></li><li style="display:inline-block;margin:0;padding:10px"><img src="https://medrx.com.br/wp-content/themes/medrx/images/selo-garantia2.png"alt="Selos MedRx"style="max-width:60px"></li></ul></div></main><footer style="background:#02708a;padding-top:25px;padding-bottom:40px;margin-top:25px"><p style="text-align:center;color:#fff;font-size:14px">© 2019 MedRx Nutracêuticos – Todos direitos reservados</p></footer></div></body></html>';
        $headers = array('Content-Type: text/html; charset=UTF-8', 'From: MedRx <sac@medrx.com.br>');   

        if( get_post_meta($data->product_id, 'stop_sell', true) == 0 ){            
            $mailResult = wp_mail( $to, $subject, $body, $headers );
            if($mailResult)
                update_post_meta( $value->ID, '_notified', 1 );

            update_post_meta( $value->ID, '_notified', 1 );           
        }
    }
}
add_action( 'avisar_produto_disponivel', 'avisar_produto_disponivel' );

// Custom Cron Recurrences
function client_notify_recurrence( $schedules ) {
    $schedules['minute'] = array(
        'display' => __( 'Minutos', 'medrx' ),
        'interval' => 3600,
    );
    return $schedules;
}
add_filter( 'cron_schedules', 'client_notify_recurrence' );

// Schedule Cron Job Event
function notificar_cliente() {
    if ( ! wp_next_scheduled( 'avisar_produto_disponivel' ) ) {
        wp_schedule_event( time(), 'minute', 'avisar_produto_disponivel' );
    }
}
add_action( 'wp', 'notificar_cliente' );



/*/////////////////////////////////////////////////////////
///////////// ACF Custom CSS: para Product Single Page
//////////////////////////////////////*/
function product_single_custom_css(){
    echo '<!--/*/////////////////////////////////////////////////////////
    ///////////// ACF Custom CSS: Product Single Page
    //////////////////////////////////////*/-->'
    .'<style>'.get_field('custom_css', get_the_ID()).'</style>';
}
add_action( 'wp_head', 'product_single_custom_css' );




function freteStyle(){
    if(is_page('finalizar-compra')){ ?>
        
    <?php }
}
add_action('init', 'freteStyle');



/** FUNÇÃO PARA CONTABILIZAR A VISUALIZAÇÃO DOS POSTS */
function medrx_set_post_views($postID) {
    $post_views = 'medrx_post_views_count';
    $count = get_post_meta($postID, $post_views, true);
    if($count == ''){
        $count = 0;
        delete_post_meta($postID, $post_views);
        add_post_meta($postID, $post_views, '0');
    }else{
        $count++;
        update_post_meta($postID, $post_views, $count);
    }
}
/* VERIFICA SE ESTA NA PÁGINA SINGLE DO POST E CHAMA A FUNÇÃO CONTAR POSTS (medrx_set_post_views) */
function medrx_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    medrx_set_post_views($post_id);
}
add_action( 'wp_head', 'medrx_track_post_views');

function medrx_get_post_views($postID){
    $count_key = 'medrx_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count == ''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}