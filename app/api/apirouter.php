<?php

declare(strict_types=1);

require dirname(__DIR__) . "/api/autoload.php";

set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handleException");

class ApiRouter {
    public function route() {

        $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $parts = explode("/", $path);

        if(!isset($parts[2]) || empty($parts[2])) {
            http_response_code(404);
            exit;
        }
        
        $resource = $parts[2];
        $id = $parts[3] ?? null;

        if($resource != "products") {
            //header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
            http_response_code(404);
            exit;
        }
        
        //require dirname(__DIR__) . "/api/controllers/TaskController.php";
        
        header("Content-type: application/json; charset=UTF-8");

        $controller = new ProductController();

        $controller->processRequest($_SERVER['REQUEST_METHOD'], $id);
    }
}