<?php
session_start ();

require 'utils/url.php';

spl_autoload_register (function ($class_name) {
	include get_uri_class_name ($class_name);
});


$url_controller = get_string_controller_from_url ();
$controller = "";

try {
	if (!file_exists (get_uri_class_name($url_controller))) {
		throw new Exception ("Class does not exist");
	}
	$controller = new $url_controller();
} catch (Exception $e) {
	if (empty ($url_controller))
		$controller = new main_page ();
	else
		header ('Location: /');
}

$controller->draw ();
