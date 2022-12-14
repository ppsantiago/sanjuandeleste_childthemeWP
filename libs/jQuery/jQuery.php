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
			$jj[] = array('postID' => $postID, 'nombre' => $nombre, 'precio' => $precio, 'categoria' => $categoria);
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
		echo $jsonStr;
	}

	wp_die();
}




// procesarForm() llamada desde AJAX
add_action('wp_ajax_nopriv_procesarForm', 'procesarForm');
add_action('wp_ajax_procesarForm', 'procesarForm');
function procesarForm()
{
	if (isset($_REQUEST)) {
		$manzana =  $_REQUEST['manzana'];

		echo $manzana;
	}

	wp_die();
}


add_action('wp_ajax_nopriv_procesarFormIndividual', 'procesarFormIndividual');
add_action('wp_ajax_procesarFormIndividual', 'procesarFormIndividual');
function procesarFormIndividual()
{
	if (isset($_REQUEST)) {
		$data =  $_REQUEST['data'];

		echo $data;
	}

	wp_die();
}

add_action('wp_ajax_nopriv_getPostID', 'getPostID');
add_action('wp_ajax_getPostID', 'getPostID');
function getPostID()
{

	if (isset($_REQUEST)) {
		$data =  $_REQUEST['data'];
		$loteID = url_to_postid($data);

		$args = array(
			'post_type' => 'product',
			'posts_per_page' => 1,
			'post__in' => array($loteID)
		);
		$the_query = new WP_Query($args);


		while ($the_query->have_posts()) : $the_query->the_post();
			global $product;

			$precio = $product->get_price();
			$postID = $the_query->post->ID;

			$jj[] = array('precio' => $precio, 'id' =>$postID);
		endwhile;
		$jsonStr = json_encode($jj);

		echo $jsonStr;
	}

	wp_die();
}
