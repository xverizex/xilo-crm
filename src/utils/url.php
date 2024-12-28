<?php

function get_string_controller_from_url () {
	$url = $_SERVER['REQUEST_URI'];
	$url = explode ('?', $url);
	$url = $url[0];
	$url = substr ($url, 1);
	$url = str_replace ("/", "_", $url);
	return $url;
}

function get_uri_class_name ($class_name) {
	return 'controllers/' . $class_name . '.php';
}
