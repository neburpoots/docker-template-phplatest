<?php
require_once __DIR__ . '/../services/orderservice.php';

class OrderController
{
    private OrderService $orderService;

    public function __construct()
    {
        $this->orderService = new OrderService();
    }

    public function myOrders()
    {
        $model = $this->orderService->getOrdersForPerson(); 
        require __DIR__ . '/../views/users/myorders.php';
    }

    public function allOrders()
    {
        $model = $this->orderService->getOrders(); 
        require __DIR__ . '/../views/admin/allorders.php';
    }
}
