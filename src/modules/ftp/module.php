<?php

require_once 'modules/module.php';

class ftp_module extends module {
	public $title = 'ftp module';
	public $controller = 'service/ftp';

	function get_title () {
		return $this->title;
	}

	function get_controller () {
		return $this->controller;
	}

	function draw_view () {
	}
}
