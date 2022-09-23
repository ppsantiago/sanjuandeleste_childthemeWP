<?php
function CalculadoraIndividual_shortcode($atts, $query)
{	// [Calculadora]

	//Formulario HTML
	ob_start();
	include('html/formularioCalculadoraIndividual.php');
	return ob_get_clean();
}
add_shortcode('CalculadoraIndividual', 'CalculadoraIndividual_shortcode');
