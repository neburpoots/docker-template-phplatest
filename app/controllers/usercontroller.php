<?php
require __DIR__ . '/../autoload.php';

class UserController {
    
	private $user;
	private $userService;
	private $validation;

	function __construct()
    {
		$patternRouter = new PatternRouter();
		$this->validation = new RegisterValidation();
		$this->userService = new UserService();
		$this->user = new User();
    }

	public function get() {
		return $this;
	}


	public function register() {
		$validation = $this->validation;
		require __DIR__ . '/../views/users/register.php';
	}

	public function login(){
		$validation = new LoginValidation();
		require __DIR__ . '/../views/users/login.php';
	}

	public function myaccount()
	{
		require __DIR__ . '/../views/users/myaccount.php';
	}

	public function loginUser(User $user) {
		return $this->userService->login($user);
	}
	
	public function registerUser(User $user) {
		$this->userService->register($user);
	}

	public function checkEmail(string $email) {
		return $this->userService->checkEmail($email);
	}
}
