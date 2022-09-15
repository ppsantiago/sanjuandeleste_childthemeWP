<?php 
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