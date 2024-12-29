<?php

require_once 'models/model.php';

class model_ftp extends model {
	public $file;
	public $host = "localhost";
	public $login = "anonymous";
	public $passwd = "anonymous";
	public $ftp;
	public $list;
	public $nlist;
	public $upper_dir;

	public function __construct () {
		if (isset ($_SESSION['open_file']))
			$this->file = $_SESSION['open_file'];

		if (isset ($_POST) && isset ($_POST['file']) && isset ($_POST['filename'])) {
			$this->ftp = ftp_connect ($this->host) or die ("Not found $this->host");
			if (!@ftp_login ($this->ftp, $this->login, $this->passwd)) {
			        die ("Not login");
			}
			header ('Content-Type: ' . 'application/octet-stream');
			header ('Content-Disposition: ' . "attachment; filename=" . $_POST['filename'] . ";");
			$fp = fopen('php://output', 'w+');
			stream_set_write_buffer($fp, 0);

			ftp_fget ($this->ftp, $fp, $_POST['file'], FTP_BINARY);

			ftp_close ($this->ftp);
		}



		$this->ftp = ftp_connect ($this->host) or die ("Not found $this->host");
		if (!@ftp_login ($this->ftp, $this->login, $this->passwd)) {
		        die ("Not login");
		}

		if (isset ($_GET) && isset ($_GET['open'])) {
			$this->file = $_GET['open'];
			if (empty ($this->file)) {
				$this->file = '/';
			}
		} else {
			$this->file = "/";
		}

		$this->list = ftp_rawlist ($this->ftp, $this->file);
		$this->nlist = ftp_nlist ($this->ftp, $this->file);

		if (isset ($this->nlist) && isset ($this->nlist[0]) && $this->nlist[0] == "/") {
			$this->file = "/";
		}

		$_SESSION['open_file'] = $this->file;

		$this->upper_dir = substr ($this->file, 0, strrpos ($this->file, "/"));

		if (isset($this->nlist) && isset ($this->nlist[0]) && $this->nlist[0] == $this->file) {
			$this->file = $this->upper_dir;
			$_SESSION['open_file'] = $this->file;
			header('Location: ' . '/service/ftp?open=' . $this->file);
		}
	}
}
