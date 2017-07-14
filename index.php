<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>API ML</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<style>
			.label {
				color: grey;
				padding:0;
			}

			.currency {
				color: red;
				font-weight: bold;
			}

			.total-reviews {
				font-size: 0.8em;
			}

			a {
			  color: black;
			  font-weight: bold;
			}

			a:link,
			a:visited {
			  text-decoration: none;
			}

			img {
				width: 100%;
			}

			.separator {
				height: 2em;
			}

			.star {
				color: orange;
			}
		</style>
	</head>

	<body>
		<?php
			$mercado_livre_url = "https://api.mercadolibre.com/sites/MLU/search?q=chromecast";
			$mercado_livre_json = file_get_contents($mercado_livre_url);
			$mercado_livre_array = json_decode($mercado_livre_json, true);
			$results = $mercado_livre_array['results'];
		?>

		<div class="page-header">
			<h1><p class="text-center">Teste da API do Mercado Livre</p></h1>
		</div>

		<div class="container">
			<?php foreach ($results as $key => $value) {?>
				<div class="col-xs-12 col-md-3">
					<div class="thumbnail">
						<img src="<?php echo $value['thumbnail']; ?>" class="img-responsive"/>
						<div class="caption">
							<a href="<?php echo $value['permalink'] ?>"><?php echo $value['title']; ?></a>
							<div>
								<span class="star glyphicon glyphicon-star-empty" aria-hidden="true"></span>
								<?php if (empty($value['reviews'])) {
									echo 'não avaliado';
								} else {?>
									<?php echo $value['reviews']['rating_average']; ?>
									<span class="total-reviews">(<?php echo $value['reviews']['total']; ?>)</span>
								<?php }?>
							</div>
							<div class="currency"><?php echo $value['currency_id'].' '.$value['price']; ?></div>
							<div><span class="label">Vendedor ID: <?php echo $value['seller']['id']; ?></span></div>
							<div><span class="label">Local: <?php echo $value['address']['state_name']; ?></span></div>
						</div>
					</div>
				</div>
				<?php if (($key+1)%4 == 0) {?>
					<div class='separator col-xs-12 col-md-12'></div>
				<?php } ?>
			<?php } ?>
		</div>
	</body>
</html>
