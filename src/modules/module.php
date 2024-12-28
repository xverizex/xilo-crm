<?php

abstract class module {
	abstract public function get_title ();
	abstract public function get_controller ();
	abstract public function draw_view ();
}
