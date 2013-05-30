<?php
/**
 * Elgg SCSS compiler
 *
 * @package ElggSCSS
 */

elgg_register_event_handler('init', 'system', 'scss_init');

function scss_init() {
	elgg_register_library('scss', elgg_get_plugins_path() . 'scss/vendors/scssphp-0.0.7/scss.inc.php');
	//make sure this runs after everyone else is done
	elgg_register_plugin_hook_handler('view', 'all', 'scss_views', 999);
}

function scss_views($hook, $type, $content, $params) {
	$view = $params['view'];

	if (preg_match("/^css\//", $view)) {
		elgg_load_library('scss');
		$scss = new scssc();
		$content = $scss->compile($content);
	}
	return $content;
}

