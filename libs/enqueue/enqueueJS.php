<?php
add_action('wp_enqueue_scripts', 'qg_enqueue');
function qg_enqueue()
{
	wp_enqueue_script(
		'qgjs',
		get_stylesheet_directory_uri() . '/js/calculadoraJQuery.js',
		array('jquery'),
		time()
	);

	wp_localize_script('qgjs', 'dcms_vars', ['ajaxurl' => admin_url('admin-ajax.php')]);
}



?>

