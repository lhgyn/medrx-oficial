<?php get_header(); ?>

<main id="main-container">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<ul id="checkout-steps" class="li">
					<li>
						<span class="ball active"></span>
						<small>Endereço</small>
					</li>
					<li class="separator"></li>
					<li>
						<span class="ball"></span>
						<small>Frete</small>
					</li>
					<li class="separator"></li>
					<li>
						<span class="ball"></span>
						<small>Pagamento</small>
					</li>
				</ul>
			</div>
			<div class="col-12">

				<div class="row">
					<div class="col-7">						
						
						<div class="tab-content" id="checkout-form">
						  <?php /*//////////////////////////////////////////////////////
						  //////// DADOS DO USUÁRIO
						  */ ?>							
						  <div class="tab-pane fade  show active" id="billing-fields" role="tabpanel" aria-labelledby="address-tab">
						  	<div class="row">
						  		<div class="col-12 mb-3"><h3>Endereço de Entrega</h3></div>
						  		<div class="col-12">
						  			<div class="card d-none">
						  				<div class="card-header">						  					
											<small id="cpf-error" class="form-text text-danger">*Não é um cpf válido</small>
											<small id="cpf-error" class="form-text text-danger">*É necessário um Telefone válido</small>
						  				</div>
						  			</div>
						  		</div>
						  		<div class="col-12">
						  			<form name="form-address" id="form-address" method="POST">
										<div class="row">
											<div class="col-6">
												<div class="form-group">
										    		<span class="has-float-label">
														<input type="text" class="form-control" name="billing_name" id="billing_name" aria-describedby="emailHelp" placeholder="Primeiro Nome">
														<label for="name">Nome</label>
													</span>
												</div>
											</div>
											<div class="col-6">											 	
												<div class="form-group">
										    		<span class="has-float-label">
														<input type="text" class="form-control" name="billing_last_name" id="billing_last_name" placeholder="Segundo nome">
														<label for="lastname">Sobrenome</label>
													</span>
												</div>
											</div>
											<div class="col-6">											 	
												<div class="form-group">
										    		<span class="has-float-label">
														<input type="text" class="form-control" name="billing_cpf" id="billing_cpf" placeholder="CPF">
														<label for="cpf">CPF</label>
													</span>  
												</div>											 	
											</div>
											<div class="col-6">											 	
												<div class="form-group">
										    		<span class="has-float-label">
														<input type="text" class="form-control" name="billing_postcode" id="billing_postcode" placeholder="CEP">
														<label for="postcode">CEP</label>
													</span>
												</div>											 	
											</div>
											<div class="col-8">											 	
												<div class="form-group">
										    		<span class="has-float-label">
														<input type="text" class="form-control" name="billing_address_1" id="billing_address_1" placeholder="Qual seu Endereço">
														<label for="address">Endereço</label>
													</span>
												</div>											 	
											</div>
											<div class="col-4">											 	
												<div class="form-group">													
										    		<span class="has-float-label">
														<input type="text" class="form-control" name="billing_number" id="billing_number" placeholder="nº casa, apt sala, etc">
														<label  for="number">Numero</label>
													</span>
												</div>											 	
											</div>
											<div class="col-6">											 	
												<div class="form-group">
										    		<span class="has-float-label">
														<input type="text" class="form-control" name="billing_neighborhood" id="billing_neighborhood" placeholder="Bairro">
														<label for="neighborhood">Bairro</label>
													</span>
												</div>											 	
											</div>
											<div class="col-6">											 	
												<div class="form-group">
										    		<span class="has-float-label">
														<input type="text" class="form-control" name="billing_address_2" id="billing_address_2" placeholder="Ex: Casa, Apartamento etc.">
														<label for="address_2">Complemento</label>
													</span>
												</div>											 	
											</div>
											<div class="col-3">											 	
												<div class="form-group">
										    		<span class="has-float-label">
														<!-- <input type="text" class="form-control" id="state" placeholder="Estado"> -->
														<select name="billing_state" name="billing_state" id="billing_state" class="form-control"></select>
														<label for="state">Estado</label>
													</span>
												</div>											 	
											</div>
											<div class="col-5">											 	
												<div class="form-group">
										    		<span class="has-float-label">
														<!-- <input type="text" class="form-control" id="city" placeholder="Cidade"> -->
														<select name="billing_city" name="billing_city" id="billing_city" class="form-control"></select>
														<label for="city">Cidade</label>
													</span>
												</div>											 	
											</div>

											<div class="col-4">											 	
												<div class="form-group">
										    		<span class="has-float-label">
														<input type="text" class="form-control" name="billing_phone" id="billing_phone" placeholder="Estado">
														<label for="phone">Telefone</label>
													</span>
												</div>											 	
											</div>

											<div class="col-4">											 	
												<div class="form-group">
										    		<span class="has-float-label">
														<input type="text" class="form-control" name="billing_email" id="billing_email" placeholder="Estado">
														<label for="phone">E-mail</label>
													</span>
												</div>											 	
											</div>
										</div>									  
									</form>
						  		</div>
						  		<div class="col-12">
						  			<ul class="nav d.flex" role="tablist">
						  				<li class="">
										    <a class="btn btn-outline-light text-secondary" href="<?php echo home_url('/carrinho') ?>">Voltar ao Carrinho</a>
										</li>
										<li class="ml-auto">
										    <a class="btn btn-primary" id="shipping-tab" data-toggle="tab" href="#shipping" role="tab" aria-controls="shipping" aria-selected="true">Escolha o Frete <i class="fas fa-arrow-right"></i></a>
										</li>
						  			</ul>
						  		</div>
						  	</div>
						  </div>
						  <?php /*//////////////////////////////////////////////////////
						  //////// FRETE
						  */ ?>
						  <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
						  	<div class="row">
						  		<div class="col-12">
						  			<div class="row">
						  				<div class="col-12">
						  					<h3>Dados de Entrega</h3>
						  				</div>
						  				<div class="col-12">
						  					<div class="card">
							  					<div class="card-header">
							  						
							  					</div>
							  				</div>
						  				</div>
						  			</div>
						  			<div class="row mt-4">
						  				<div class="col-12">
						  					<h3>Método de Envio</h3>
						  				</div>
						  				<div class="col-12">
						  					<div class="card">
							  					<div class="card-header">


							  					</div>
							  				</div>
						  				</div>
						  			</div>
						  		</div>
						  		<div class="col-12 mt-4">
						  			<ul class="nav d.flex" role="tablist">
										<li class="">
										    <a class="btn btn-outline-secondary" id="address-tab" data-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fas fa-arrow-left"></i> Editar Endereço</a>
										</li>
										<li class="ml-auto">
										    <a class="btn btn-primary" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="true">Escolher Pagamento <i class="fas fa-arrow-right"></i></a>
										</li>
						  			</ul>
						  		</div>
						  	</div>
						  </div>
						  <?php /*//////////////////////////////////////////////////////
						  //////// PAGAMENTO
						  */ ?>
						  <div class="tab-pane fade" id="payment" role="payment" aria-labelledby="payment-tab">
						  	<div class="row">
						  		<div class="col-12 mb-4"><h3>Pagamento</h3></div>
						  		<div class="col-12 mt-4">
						  			<ul class="nav d.flex" role="tablist">
										<li class="">
									    	<a class="btn btn-outline-secondary" id="shipping-tab" data-toggle="tab" href="#shipping" role="tab" aria-controls="shipping" aria-selected="false"><i class="fas fa-arrow-left"></i> Editar Frete</a>
									  	</li>
									  	<li class="ml-auto">
									    	<a class="btn btn-primary" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="messages" aria-selected="false">Finalizar Compra <i class="fas fa-arrow-right"></i></a>
									  	</li>
									</ul>
						  		</div>
						  	</div>
						  </div>
						</div>

					</div>

					<div class="col-5">

			  			
					</div>

				</div>

			</div>
		</div>
	</div>
</main>


<?php get_footer(); ?>