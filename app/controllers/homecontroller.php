<?php

class HomeController {
	public function index() {
		require __DIR__ . '/../views/home/index.php';
	}

	public function disclaimer(){
		require __DIR__ . '/../views/home/disclaimer.php';
	}
	
}
