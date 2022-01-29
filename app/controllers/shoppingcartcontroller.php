<?php
require __DIR__ . '/../autoload.php';

class ShoppingCartController {
    
    private ProductService $productService;
    private OrderService $orderService;

    public function __construct()
    {
        $this->productService = new ProductService();
        $this->orderService = new OrderService();
    }

	public function index() {
        if (!isset($_SESSION['shoppingcart'])) {
            $shoppingCart = new ShoppingCart();
            $_SESSION["shoppingcart"] = serialize($shoppingCart);
        }
        
		require __DIR__ . '/../views/shoppingcart/index.php';
	}

    public function addToCart() {
        try {
            $id = (int)htmlspecialchars($_GET["id"]);
            $product = $this->productService->detail($id);
            $cartItem = new CartProduct($product, 1);
            
            if (!isset($_SESSION['shoppingcart'])) {
                $shoppingCart = new ShoppingCart();
                $_SESSION["shoppingcart"] = serialize($shoppingCart);
            }

            $shoppingCart = unserialize($_SESSION["shoppingcart"]);
            $shoppingCart->addToCart($cartItem);
            $_SESSION["shoppingcart"] = serialize($shoppingCart);
            header('Location: /shoppingcart');
        } catch(Exception $e) {
            http_response_code(404);
        }
    }

    public function increaseAmount() {
        try {
            $id = (int)htmlspecialchars($_GET["id"]);

            $shoppingCart = unserialize($_SESSION["shoppingcart"]);
            $shoppingCart->increaseAmount($id);
            $_SESSION["shoppingcart"] = serialize($shoppingCart);
            header('Location: /shoppingcart');
        } catch(Exception $e) {
            http_response_code(404);
        }
    }

    public function decreaseAmount() {
        try {
            $id = (int)htmlspecialchars($_GET["id"]);

            $shoppingCart = unserialize($_SESSION["shoppingcart"]);
            $shoppingCart->decreaseAmount($id);
            $_SESSION["shoppingcart"] = serialize($shoppingCart);
            header('Location: /shoppingcart');
        } catch(Exception $e) {
            http_response_code(404);
        }
    }

    public function removeItem() {
        try {
            $id = (int)htmlspecialchars($_GET["id"]);

            $shoppingCart = unserialize($_SESSION["shoppingcart"]);
            $shoppingCart->deleteFromCart($id);
            $_SESSION["shoppingcart"] = serialize($shoppingCart);
            header('Location: /shoppingcart');
        } catch(Exception $e) {
            http_response_code(404);
        }
    }

    public function orderItems() {
        try {
            $shoppingCart = unserialize($_SESSION["shoppingcart"]);

            if(isset($_SESSION["user"])) {
                $user = unserialize($_SESSION["user"]);
                $order = new Order();
                $order->setUser_id($user->getId());
                
                foreach($shoppingCart->getCartProducts() as $cartProduct) {
                    $order_line = new Order_line();
                    $order_line->setProduct($cartProduct->getProduct());
                    $order_line->setQuantity($cartProduct->getAmount());
                    $order->addOrder_Line($order_line);
                }
                $this->orderService->makeOrder($order);
                unset($_SESSION["shoppingcart"]);
                $shoppingCartNew = new ShoppingCart();
                $_SESSION["shoppingcart"] = serialize($shoppingCartNew);
                header('Location: /thanksforordering');
            } else {
                header('Location: /login');
            }
        } catch(Exception $e) {
            http_response_code(404);
        }
    }

    public function thanksForOrdering() {
        echo "test";
        require __DIR__ . '/../views/thanksforordering.php';
    }
}
