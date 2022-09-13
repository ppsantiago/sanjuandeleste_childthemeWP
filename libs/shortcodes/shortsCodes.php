<?php
function Calculadora_shortcode($atts, $query)
{
	// [Calculadora Cal="99"]

	//Parametros del shortcode
	$atts = shortcode_atts(
		array(
			'cat_name' => '353',
			'lte' => '44'
			//Valor de parametro por defecto
		),
		$atts,
		'Calculadora'
	);



	//Formulario HTML
?>

	<form>
		<form action="#" method="post">

			<label for="name">Nombre:</label>
			<input type="text" id="name" name="user_name">

			<label for="mail">Correo electrónico:</label>
			<input type="email" id="mail" name="user_mail">
			
			<label for="adelanto">Adelanto</label>
			<input type="number" id="adelanto" name="adelanto" min="2000" max="25000" step="1000">
			
			<label for="cuotas">Cuotas</label>
			<select name="cuotas" id="cuotas">
				<option value="12">12</option>
				<option value="24">24</option>
				<option value="36">36</option>
				<option value="48">48</option>
				<option value="60">60</option>
				<option value="72">72</option>
			</select>
			<label for="manzanas">Manzanas</label>
			<select name="manzanas" id="manzanas" class="manzanaSelect">
				<option value="manzana1">Manzana 1</option>
				<option value="manzana2">Manzana 2</option>
				<option value="manzana3">Manzana 3</option>
				<option value="manzana4">Manzana 4</option>
				<option value="manzana5">Manzana 5</option>
				<option value="manzana6">Manzana 6</option>
				<option value="manzana7">Manzana 7</option>
			</select>

			<label for="lote">Lote</label>
			<select name="lote" id="lote" class="loteSelect">

			</select>



			<!-- <button id="btn1" class="boton1">Click me MTF</button> -->
		</form>
	</form>


<?php

	return;
}
add_shortcode('Calculadora', 'Calculadora_shortcode');


function LoteToolDesc_shortcode($atts, $query)
{
	// [LoteToolDesc lote_id="1092"]
	$atts = shortcode_atts(
		array(
			'lote_id' => '353',
		),
		$atts,
		'LoteToolDesc'
	);

	$args = ['p' => $atts['lote_id'], 'post_type' => 'product'];
	$loop = new WP_Query($args);


	while ($loop->have_posts()) : $loop->the_post();
		global $product;

		if ($loop->post->ID == $atts['lote_id']) {
			$alto = $product->get_width();
			$ancho = $product->get_height();
			$dimension = (intval($alto) * intval($ancho));
			$nombre = get_the_title($loop->post->ID);
			$precio = $product->get_price();
			$cat2 = get_the_terms($loop->ID, 'product_cat');
			foreach ($cat2 as $valor) {
				$categoria = $valor->name;
			}
			$calculadora = "http://localhost/pueblo/calculadora-" . $categoria;
			$enlace = get_permalink($product->ID);
		}

	endwhile;
	return $nombre . "<br>Precio: $" . $precio . ".-<br>" . $categoria . "<br>Calculadora: <a href=" . $calculadora . ">Calculadora</a><br>Ver: <a href=" . $enlace . ">$nombre</a><br>Dimension: " . $dimension . "M²";
}
add_shortcode('LoteToolDesc', 'LoteToolDesc_shortcode');


?>
