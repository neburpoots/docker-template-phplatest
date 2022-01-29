<?php
require __DIR__ . '/../repositories/orderrepository.php';

class OrderService {
    private $repository;

    function __construct()
    {
		$this->repository = new OrderRepository();
    }
    
    public function makeOrder(Order $order) {
        //Makes the order
        $this->repository->makeOrder($order);
        //Gets the id from the order
        $order->setOrder_id($this->repository->getOrderId());
        //Makes the order lines
        $this->repository->makeOrder_Lines($order);
    }

    public function getOrdersForPerson() : array {
      return $this->repository->getOrdersForPerson();
    }

    public function getOrders() : array {
      return $this->repository->getOrders();
    }
}