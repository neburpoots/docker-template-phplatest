<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../models/Product.php';

class ProductRepository extends Repository {

    function index() {
        try {
            $stmt = $this->connection->prepare("SELECT product_id, name, price, stock, img, description
            FROM Products;");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            $products = $stmt->fetchAll();

            return $products;

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    function detail(int $id) : Product {
        try {
            $sql = "SELECT product_id, name, price, stock, img, description
            FROM Products
            WHERE product_id = :product_id";

            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":product_id", $id, PDO::PARAM_INT);
            
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $product = new Product();
                $product->setId($data['product_id']);
                $product->setName($data['name']);
                $product->setPrice($data['price']);
                $product->setStock($data['stock']);
                $product->setImg($data['img']);
                $product->setDescription($data['description']);
                return $product;
            } else {
                return null;
            }

        } catch (PDOException $e)
        {
            echo $e;
        }
    }


}