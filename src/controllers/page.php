<?php

class page {
	public function get_header () {
		return $_SERVER['DOCUMENT_ROOT'] . '/views/header.php';
	}

	public function get_footer () {
		return $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php';
	}
}
