

<div class="col-12">
	<ul id="checkout-steps" class="li">
		<li>
			<span id="checkout-step1" class="ball active"></span>
			<small>Endereço</small>
		</li>
		<li class="separator"></li>
		<li>
			<span id="checkout-step2" class="ball"></span>
			<small>Frete</small>
		</li>
		<li class="separator"></li>
		<li>
			<span id="checkout-step3" class="ball"></span>
			<small>Pagamento</small>
		</li>
	</ul>
</div>

<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>
<div class="row">
	<div class="col-12 col-lg-8">
		<div class="woocommerce-form-login-toggle">
			<?php if(!is_user_logged_in()):
			wc_print_notice( apply_filters( 'woocommerce_checkout_login_message', __( 'Returning customer?', 'woocommerce' ) ) . ' <a href="#" class="showlogin">' . __( 'Click here to login', 'woocommerce' ) . '</a>', 'notice' ); ?>
			</div>
			<?php

			woocommerce_login_form(
				array(
					'message'  => __( 'If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing &amp; Shipping section.', 'woocommerce' ),
					'redirect' => wc_get_page_permalink( 'checkout' ),
					'hidden'   => true,
				)
			); endif; ?>
	</div>
</div>
<form name="checkout" id="checkout-form" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" data-status="<?php echo is_user_logged_in() == true?'loged':'nologed' ?>" style="width: 100% !important;">
<div class="row" style="width: 100% !important;">
<div class="col-8">

	
	<div class="checkout-step-tabs">
	  <?php/*//////////////////////////////////////////
		///////// FORMULÁRIO DE PEDIDO
		///////////////////////*/?>			  
	  <div  id="tab-one" class="tab-child">
	  	<h3>Informações</h3>
		<div class="billing-card card p-3 pt-5">
			<?php if ( $checkout->get_checkout_fields() ) : ?>

				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

				<div class="row" id="customer_details">
					<div class="col-12">
						<?php do_action( 'woocommerce_checkout_billing' ); ?>								

					</div>

					<div class="col-12">
						<?php do_action( 'woocommerce_checkout_shipping' ); ?>
					</div>
				</div>

				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

			<?php endif; ?>
		</div>
	  </div>
	  <?php/*//////////////////////////////////////////
		///////// ENDEREÇOS DE ENTREGA E FRETE
		///////////////////////*/?>			  
	  <div  id="tab-two" class="tab-child" style="display: none;">
			<h3>Local de Entrega</h3>
			<div class="card p-3 mb-5">
				<span id="local-de-entrega"></span>
			</div>
			<h3>Escolha o Frete</h3>						
			<div class="card p-3">
				<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>			    
				    <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

				        <table class="my-custom-shipping-table"><!-- Our table -->
				            <tbody>
				             <?php wc_cart_totals_shipping_html(); ?>
				            </tbody>
				        </table>

				    <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
				<?php endif; ?>
			</div>
	  </div>
	  <?php/*//////////////////////////////////////////
		///////// PAGAMENTO
		///////////////////////*/?>			  	  			  
	  <div  id="tab-three" class="tab-child" style="display: none;">
	  	<h3>Pagamento</h3>
			<div class="card p-3 pt-4">
				<?php					

					if ( ! is_ajax() ) {
						do_action( 'woocommerce_review_order_before_payment' );
					}
					?>
					<div id="payment" class="woocommerce-checkout-payment">
						<?php if ( WC()->cart->needs_payment() ) : ?>
							<ul class="wc_payment_methods payment_methods methods">
								<?php
								if ( ! empty( $available_gateways ) ) {
									foreach ( $available_gateways as $gateway ) {
										wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
									}
								} else {
									echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</li>'; // @codingStandardsIgnoreLine
								}
								?>
							</ul>
						<?php endif; ?>
						<div class="form-row place-order">
							<noscript>
								<?php esc_html_e( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ); ?>
								<br/><button type="submit" class="button alt d-none" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
							</noscript>

							<?php wc_get_template( 'checkout/terms.php' ); ?>

							<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

							<?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>

							<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

							<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
						</div>
					</div>
					<?php
					if ( ! is_ajax() ) {
						do_action( 'woocommerce_review_order_after_payment' );
					}

				?>
			</div>
	  </div>
	</div>


	<?php/*//////////////////////////////////////////
	///////// NAVEGAÇÃO DAS ABAS
	///////////////////////*/?>	
	<div class="row mt-5">
		<div class="col">
			<nav id="checkout-step-buttons" class="checkout-step-buttons">
			    <div class="col-12 p-0">
			    	<a class="btn btn--1 btn-primary" id="btn-cart" href="<?php echo home_url('/carrinho') ?>" style="float: left"><i class="fas fa-angle-double-left"></i> Ver Carrinho</a>
				    <a class="button-tabs btn--2 btn btn-primary" href="#tab-one" id="btn-one" data-tab="tab-one" style="display: none"><i class="fas fa-angle-double-left"></i> Minhas Informações</a>
				    <a class="button-tabs btn--3 btn btn-primary" href="#tab-two" id="btn-two" data-tab="tab-two" style="float:right"><i id='icon-seta-step-left' class="fas fa-angle-double-left" style="display: none"></i> Escolher Frete <i id='icon-seta-step-right' class="fas fa-angle-double-right icon-seta-step"></i></a>
				    <a class="button-tabs btn--4 btn btn-primary" href="#tab-three" id="btn-three" data-tab="tab-three" style="display: none">Escolher Pagamento <i class="fas fa-angle-double-right"></i></a>
				    <!-- <a class="btn btn--5 btn-primary" id="btn-checkout" href="#" style="display: none">Finalizar Pedido <i class="fas fa-angle-double-right"></i></a> -->
			    </div>
			</nav>
		</div>
	</div>
	<?php /****** FIM DA NAVEGAÇÃO */ ?>

</div>

<?php/*//////////////////////////////////////////
///////// REVIEW DO PEDIDO
///////////////////////*/?>	
<div id="review-side"  class="col-4" style="margin-top: 42px;">
	<div class="row p-3 bg-light">
		<div class="col-12 p-0">
			<div class="card">
				<?php 
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					?>

					<div class="media review-items" style="border-bottom: 1px solid #ccc">
					  <img class="align-self-center mr-3" src="<?php echo get_the_post_thumbnail_url( $cart_item['variation_id'], 'medium' ) ?>" style="width: 80px;" alt="">
					  <div class="media-body pr-2">
					    <p class="mt-0"><strong class="text-uppercase"><?php echo $cart_item['data']->description ?></strong></p>
					    <p>
					    	<span class="ml-auto"><?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?></span>
					    	<span class="ml-auto"><?php echo wc_get_formatted_cart_item_data( $cart_item ); ?></span>
					    	<span class="mr-auto"><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?></span>				    	
					    </p>
					  </div>
					</div>
					<?php
					}
				}

			?>
		</div>
		
		<div class="col-12 p-0">
			<table class="woocommerce-checkout-review-order-table" style="border: none !important; ">
				<tr class="cart-subtotal">
					<th><?php _e( 'Subtotal', 'woocommerce' ); ?></th>
					<td><?php wc_cart_totals_subtotal_html(); ?></td>
				</tr>

				<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
					<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
						<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
					</tr>
				<?php endforeach; ?>

				<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

					<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

					<?php wc_cart_totals_shipping_html(); ?>

					<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

				<?php endif; ?>

				<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
					<tr class="fee">
						<th><?php echo esc_html( $fee->name ); ?></th>
						<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
					</tr>
				<?php endforeach; ?>


				<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

				<tr class="order-total">
					<th><?php _e( 'Total', 'woocommerce' ); ?></th>
					<td><?php wc_cart_totals_order_total_html(); ?></td>
				</tr>

				<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
			</table>

			</div>
		</div>
	</div>	
</div>

</div>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

<script>
	jQuery(document).ready(function($) {
		$( document ).ajaxComplete(function(){
			$('#shipping-total').remove()
			
			var selected_method = $('input[class=shipping_method]:checked').val();
			var method_id = $('input[class=shipping_method]:checked').attr('id');
			var method_price = $(`label[for=${method_id}] > span`).html();
			
			response = '<th>Entrega</th><td>'+method_price+'</td>';
			if(method_price != undefined){
				if( $( 'table:not(:has(tr#shipping-total))' ) ) {
				    $( '<tr id="shipping-total">'+response+'</tr>' ).insertAfter( $( ".cart-subtotal" ) );
				}
				else{
					$('#shipping-total').html(response);
					console.log('já existe');
				}
			}
			
				
		})		
	});

</script>

<!-- <script>
	jQuery(document).ready(function($) {
		$( document ).ajaxComplete(function(){
			$('#shipping-total').remove()

			data = '<?php //echo number_format(WC()->session->get( 'cart_totals', null )['shipping_total'], 2,',','.') ?>';//'<th>Entrega</th><td>'+data+'</td>';
			response = '<tr id="shipping-total"><th>Entrega</th><td>R$'+data+'</td></tr>';
			
			//response = '<th>Entrega</th><td>'+data+'</td>';
			$('#shipping-total').html(response);
			if( $( 'table:not(:has(tr#shipping-total))' ) ) {
			    $( '<tr id="shipping-total">'+response+'</tr>' ).insertAfter( $( ".cart-subtotal" ) );			    
			}
			else{
				$('#shipping-total').html(response);
				console.log('já existe');
			}
		})		
	});
</script> -->