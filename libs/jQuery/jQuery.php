<?php


// -------------------------------------- Llamada hook AJAX ----------------------------------//
// add_action('Prefico wp_ajax_nopriv_ | Action del JS manzanaAction , nombre de Function ')--//
// add_action('Prefico wp_ajax_ | Action del JS manzanaAction , nombre de Function ')---------//
//--------------------------------------------------------------------------------------------//


// manzanaAction() llamada desde AJAX
add_action('wp_ajax_nopriv_manzanaAction', 'manzanaAction');
add_action('wp_ajax_manzanaAction', 'manzanaAction');
function manzanaAction()
{

	if (isset($_REQUEST)) {
		$args = array(
			'posts_per_page' => 200,
			'post_type' => 'product',
			'orderby' => 'id',
		);
		$the_query = new WP_Query($args);

		while ($the_query->have_posts()) : $the_query->the_post();
			global $product;
			$nombre =  get_the_title($the_query->post->ID);
			$precio = $product->get_price();
			$postID = $the_query->post->ID;
			$cat2 = get_the_terms($the_query->ID, 'product_cat');
			foreach ($cat2 as $valor) {
				$categoria = $valor->slug;
			}
			$jj[] = array('postID' =>$postID,'nombre' => $nombre, 'precio' => $precio, 'categoria' => $categoria);
		endwhile;

		$jsonStr = json_encode($jj);
		echo $jsonStr;
	}

	wp_die();
}

// loteAction() llamada desde AJAX
add_action('wp_ajax_nopriv_loteAction', 'loteAction');
add_action('wp_ajax_loteAction', 'loteAction');
function loteAction()
{
	if (isset($_REQUEST)) {
		$manzana =  $_REQUEST['manzana'];
		$args = array(
			'posts_per_page' => 200,
			'post_type' => 'product',
			'orderby' => 'id',
		);
		$the_query = new WP_Query($args);
		$jj[] = array();
		while ($the_query->have_posts()) : $the_query->the_post();

		endwhile;
		$jsonStr = json_encode($jj);
		/*
		while ($the_query->have_posts()) : $the_query->the_post();
			global $product;
			$nombre =  get_the_title($the_query->post->ID);
			$precio = $product->get_price();
			$cat2 = get_the_terms($the_query->ID, 'product_cat');
			foreach ($cat2 as $valor) {
				$categoria = $valor->slug;
			}
			$jj[] = array('nombre' => $nombre, 'precio' => $precio, 'categoria' => $categoria);
			$o++;
		endwhile;

		$jsonStr = json_encode($jj);
		 **/
		echo $jsonStr;
	}

	wp_die();
}


?>