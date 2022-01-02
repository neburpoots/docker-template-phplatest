<?php
if(!isset($_SESSION)) 
{ 
    session_start();     
}

class PatternRouter {

    private function stripParameters($uri) {
        if(str_contains($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        return $uri;
    }

    public function route($uri) {

        $uri = $this->stripParameters($uri);
        $explodedUri = explode('/', $uri);


        //REDIRECT TO THE API ROUTER IN CASE OF api in url
        if($explodedUri[0] == "api") {
            
            require __DIR__ . '/api/apirouter.php';

            $apirouter = new ApiRouter();

            $apirouter->route();
            die();
        }
        
        //AUTOLOAD AFTER API
        require 'autoload.php';

        //Clears the user session
        if($explodedUri[0] == "logout") {
            unset($_SESSION["user"]);
            header('Location: /');
        }

        //Clears the shoppingcart session
        if($explodedUri[0] == "clearshoppingcart") {
            unset($_SESSION["shoppingcart"]);
            header('Location: /');
        }

        if($explodedUri[0] == "thanksforordering") {
            $shoppingCartController = new ShoppingCartController();
            $shoppingCartController->thanksForOrdering();
            die();
        }

        if($explodedUri[0] == "order") {
            if(isset($_SESSION["user"])) {
                require __DIR__ . '/controllers/ordercontroller.php';
                $userController = new OrderController();
                $userController->myOrders();
                die();
            } else {
                header('Location: /login');
                die();
            }
        }

        if($explodedUri[0] == "allproducts") {
            if(isset($_SESSION["user"])) {
                $user = unserialize($_SESSION["user"]);
                $role = $user->getRole();
                if ($role->getId() == 2 || $role->getName() == "Admin") {
                    $productController = new ProductController();
                    $productController->adminindex();
                }
                die();
            } else {
                header('Location: /login');
                die();
            }
        }

        if($explodedUri[0] == "createproduct") {
            if(isset($_SESSION["user"])) {
                $user = unserialize($_SESSION["user"]);
                $role = $user->getRole();
                if ($role->getId() == 2 || $role->getName() == "Admin") {
                    $productController = new ProductController();
                    $productController->create();
                }
                die();
            } else {
                header('Location: /login');
                die();
            }
        }

        
        if($explodedUri[0] == "productedit") {
            if(isset($_SESSION["user"])) {
                $user = unserialize($_SESSION["user"]);
                $role = $user->getRole();
                if ($role->getId() == 2 || $role->getName() == "Admin") {
                    if(is_numeric($explodedUri[1])) {
                        $productController = new ProductController();
                        $productController->edit();
                    }
                    die();
                }
                die();
            } else {
                header('Location: /login');
                die();
            }
        }


        //FOR THE USERS
        if($explodedUri[0] == "login") {
            if(isset($_SESSION["user"])) {
                try {
                    require __DIR__ . '/controllers/usercontroller.php';
                    $userController = new UserController();
                    $userController->myaccount();
                    die();
                } catch (Exception $e) {
                    http_response_code(404);
                }
            } else {
                try {
                    require __DIR__ . '/controllers/usercontroller.php';
                    $userController = new UserController();
                    $userController->login();
                    die();
                } catch (Exception $e) {
                    http_response_code(404);
                }
            }

        } else if($explodedUri[0] == "register") {
            try {
                require __DIR__ . '/controllers/' . 'usercontroller' . '.php';
                $userController = new UserController();
                $userController->register();
                die();
            } catch (Exception $e) {
                http_response_code(404);
            }
        }

        if(!isset($explodedUri[0]) || empty($explodedUri[0])) {
            $explodedUri[0] = 'home';
        }
        $controllerName = $explodedUri[0] . "controller";

        if(!isset($explodedUri[1]) || empty($explodedUri[1])) {
            $explodedUri[1] = 'index';
        }

        $methodName = $explodedUri[1];

        try {
            require __DIR__ . '/controllers/' . $controllerName . '.php';
            $controllerObj = new $controllerName();
            $controllerObj->$methodName();
        } catch (Exception $e) {
            http_response_code(404);
        }
    }
}