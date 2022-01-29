<?php

require_once __DIR__ . '/../models/Order_Line.php';
require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Role.php';


class OrderRepository extends Repository {
    
    function makeOrder(Order $order) {
        try {
            $sql = "INSERT INTO Orders (user_id, orderdate)
            VALUES (:user_id, :orderDate)";
    
            $stmt = $this->connection->prepare($sql);

            $stmt->bindValue(":user_id", $order->getUser_Id(), PDO::PARAM_INT);
            $stmt->bindValue(":orderDate", date("Y-m-d H:i:s"), PDO::PARAM_STR);

            $stmt->execute();
            return true;

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    function getOrderId() : int {
        try {
            $sql = "SELECT order_id 
                    FROM Orders 
                    WHERE order_id=(SELECT max(order_id) FROM Orders);";
    
            $stmt = $this->connection->prepare($sql);

            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                return $data['order_id'];
            }

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    function makeOrder_Lines(Order $order) {
        try {
            $sql = "INSERT INTO Order_Lines (order_id, product_id, quantity)
            VALUES ";

            foreach($order->getOrder_Lines() as $order_line) {
                $sql = $sql . "(?,?,?),";
            }
            //Removes last comma
            $sql = substr($sql , 0, -1);
            
            $stmt = $this->connection->prepare($sql);

            $values = array();
            foreach($order->getOrder_Lines() as $order_line) {
                $values2 = array($order->getId(), $order_line->getProduct()->getId(), $order_line->getQuantity());
                $values = array_merge($values,$values2);
            }

            $stmt->execute($values);
        
            return true;

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    function getOrdersForPerson() : array {
        try {
            $sql = "SELECT order_id, user_id, orderdate
            FROM Orders
            WHERE user_id = :user_id;";

            $stmt = $this->connection->prepare($sql);

            $user = unserialize($_SESSION['user']);

            $stmt->bindValue(":user_id", $user->getId(), PDO::PARAM_INT);
            
            $stmt->execute();

            $orders = array();



            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $order = new Order();
                $order->setOrder_id($row['order_id']);
                $order->setUser_id($row['user_id']);

                $date = new DateTime($row['orderdate']);
                $order->setOrderDate($date);
                $order = $this->getOrderLinesForOrder($order);
                $orders[] = $order;
                            
            }

            return $orders;

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    function getOrderLinesforOrder(Order $order) : Order  {
        try {
            $sql = "SELECT order_id, order_line_id, O.product_id, quantity, P.name, P.price, P.img
            FROM Order_Lines as O
            inner join Products P on O.product_id = P.product_id
            WHERE order_id = :order_id;";

            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":order_id", $order->getId(), PDO::PARAM_INT);
            
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $order_line = new Order_Line();
                $order_line->setOrder_id($row['order_id']);
                $order_line->setOrder_Line_Id($row['order_line_id']);
                $order_line->setQuantity($row['quantity']);

                $product = new Product();
                $product->setId($row['product_id']);
                $product->setName($row['name']);
                $product->setImg($row['img']);
                $product->setPrice($row['price']);
                $order_line->setProduct($product);

                $order->addOrder_Line($order_line);
            }
            return $order;
        } catch(PDOException $e) {
            echo $e;
        }
    }

    function getOrders() : array {
        try {
            $sql = "SELECT order_id, user_id, orderdate
            FROM Orders";
            $stmt = $this->connection->prepare($sql);
            $user = unserialize($_SESSION['user']);

            $stmt->execute();

            $orders = array();



            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $order = new Order();
                $order->setOrder_id($row['order_id']);
                $order->setUser_id($row['user_id']);

                $date = new DateTime($row['orderdate']);
                $order->setOrderDate($date);
                $order = $this->getOrderLinesForOrder($order);
                $orders[] = $order;
                            
            }

            return $orders;

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    
}