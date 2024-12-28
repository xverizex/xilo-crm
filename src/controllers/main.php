<?php

require_once 'models/model_modules.php';
require_once 'models/model_main_page.php';

class main extends page {

	public function __construct () {


	}

	public function draw () {
		$view = $_SERVER['DOCUMENT_ROOT'] . '/views/main_page_view.php';

		$model_page = new model_main_page ();
		$model_modules_class = new model_modules ();
		$model_modules = $model_modules_class->modules;

		include_once parent::get_header ();
		include_once "$view";
		include_once parent::get_footer ();
	}
}
