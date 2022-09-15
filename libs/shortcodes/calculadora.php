<?php
function Calculadora_shortcode($atts, $query)
{	// [Calculadora]

	//Formulario HTML
	ob_start();
	include('html/formularioCalculadora.php');
	return ob_get_clean();
}
add_shortcode('Calculadora', 'Calculadora_shortcode');
