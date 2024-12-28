<?php

require_once 'models/model_ftp.php';
require_once 'models/model_ftp_page.php';

class service_ftp extends page {
	public function __construct () {

	}

	public function draw () {
		$view = $_SERVER['DOCUMENT_ROOT'] . '/views/service_ftp_view.php';

		$model_page = new model_ftp_page ();
		$model_ftp = new model_ftp ();

		include_once parent::get_header ();
		include_once "$view";
		include_once parent::get_footer ();
	}
}
