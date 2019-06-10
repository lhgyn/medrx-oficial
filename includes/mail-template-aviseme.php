<?php

$template = '<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>MedRx Nutraceutikos</title>
	<link rel="stylesheet" href="">
	<link href="https://fonts.googleapis.com/css?family=Rubik:400,500,700" rel="stylesheet">
</head>
<body style="font-family: 'Rubik', sans-serif;">

	<div style="display: block; margin:0 auto; max-width:750px; padding-top: 15px;">
		<header style="background: #ccc; padding-top: 25px;padding-bottom: 25px;">
			<h1 style="text-align: center;">
				<img src="https://medrx.com.br/wp-content/themes/medrx/images/logo4.png" alt="MedRx" style="max-width: 100px;">
			</h1>
		</header>

		<main>
			<div>
				<div style="text-align: center;">
					<h4>Olá '.$data->name.'</h4>
					<p>O produto que você quer chegou em nosso estoque.</p>
					<p>Corre lá para garantir o seu antes que acabe outra vez.</p>
				</div>
				<div style="text-align: center;">
					<a href="'.$data->product_link.'">
						<img src="'.$data->product_image.'" alt="'.$data->product_name.'" style="margin: 0 auto">
					</a>					
				</div>
				<div style="text-align: center; margin-top: 25px;margin-bottom: 50px;">
					<a href="'.$data->product_link.'" style="text-decoration:none;color:#fff;background:darkorange;background::hover:black;padding:10px 45px;border-radius: 10px; border-bottom: 3px solid darkgoldenrod; font-size: 26px;">COMPRAR</a>
				</div>
			</div> 
			<hr>
			<ul style="list-style: none;margin: 0 auto;padding: 0;width:80%;display: flex;align-items: center;justify-content: space-between;">
				<li><img src="https://medrx.com.br/wp-content/themes/medrx/images/selo-satisfacao2.png" alt="Selos MedRx" style="max-width: 60px"></li>
				<li><img src="https://medrx.com.br/wp-content/themes/medrx/images/lock-cert3.png" alt="Selos MedRx" style="max-width: 60px"></li>
				<li><img src="https://medrx.com.br/wp-content/themes/medrx/images/logo-pagarme-1.png" alt="Selos MedRx" style="max-width: 60px"></li>
				<li><img src="https://medrx.com.br/wp-content/themes/medrx/images/selo-card.png" alt="Selos MedRx" style="max-width: 60px"></li>
				<li><img src="https://medrx.com.br/wp-content/themes/medrx/images/selo-garantia2.png" alt="Selos MedRx" style="max-width: 60px"></li>
			</ul>
		</main>

		<footer style="background: #02708a;padding-top: 25px;padding-bottom: 40px;margin-top: 25px">
			<p style="text-align: center; color: #fff;font-size: 14px">© 2019 MedRx Nutracêuticos – Todos direitos reservados</p>
		</footer>
	</div>
	
</body>
</html>';