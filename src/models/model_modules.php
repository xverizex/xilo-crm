<?php

require_once 'models/model.php';

class model_modules extends model {
	public $modules;

	function __construct () {
		$dir = opendir ('modules');
		$this->modules = [];

		while ($file = readdir ($dir)) {
			if ((filetype ('modules/' . $file) == 'dir') && ($file != '.' && $file != '..')) {
				$uri_module = 'modules/' . "$file/" . 'module.php';
				require_once $uri_module;
				$module_class = $file . '_module';
				$module = new $module_class();
				$this->modules[$module->get_title()] = $module->get_controller();
			}
		}

		closedir ($dir);
	}
}
