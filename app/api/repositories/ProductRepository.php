<?php
require dirname(__DIR__) . "/autoload.php";

class ProductRepository extends Repository {

    function index() {
        try {
            $stmt = $this->connection->prepare("SELECT product_id, name, price, stock, img, description
                                                FROM Products;");
            $stmt->execute();

            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $products;

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function detail(string $id) : array | false
    {
        $sql = "SELECT product_id, name, price, stock, img, description
        FROM Products
        WHERE product_id = :product_id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(":product_id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    public function create(array $data): string {
        $sql = "INSERT INTO Products (name, price, stock, img, description)
                VALUES (:name, :price, :stock, :img, :description)";
        
        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindValue(":price", $data["price"], PDO::PARAM_STR);
        $stmt->bindValue(":stock", $data["stock"], PDO::PARAM_INT);
        $stmt->bindValue(":img", $data["img"], PDO::PARAM_STR);
        $stmt->bindValue(":description", $data["description"], PDO::PARAM_STR);


        // if(empty($data["priority"])) {
        //     $stmt->bindValue(":priority", null, PDO::PARAM_NULL);
        // } else {
        //     $stmt->bindValue(":priority", $data["priority"], PDO::PARAM_INT);
        // }

        $stmt->execute();
        
        return $this->connection->lastInsertId();
    }

    public function update(string $id, array $data) : int {
        $fields = [];

        if(!empty($data["name"])) {
            $fields["name"] = [
                $data["name"],
                PDO::PARAM_STR
            ];
        }

        if(!empty($data["price"])) {
            $fields["price"] = [
                $data["price"],
                PDO::PARAM_STR
            ];
        }

        if(!empty($data["stock"])) {
            $fields["stock"] = [
                $data["stock"],
                PDO::PARAM_INT
            ];
        }

        if(!empty($data["img"])) {
            $fields["img"] = [
                $data["img"],
                PDO::PARAM_STR
            ];
        }

        if(!empty($data["img"])) {
            $fields["img"] = [
                $data["img"],
                PDO::PARAM_STR
            ];
        }

        if(!empty($data["description"])) {
            $fields["description"] = [
                $data["description"],
                PDO::PARAM_STR
            ];
        }


        if(empty($fields)) {
            return 0;
        } else {
            $sets = array_map(function($value) {
                return "$value =  :$value";
            }, array_keys($fields));
    
            $sql = "UPDATE Products"
                . " SET " . implode(", ", $sets)
                . " WHERE product_id = :id";
    
            $stmt = $this->connection->prepare($sql);

            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            foreach($fields as $name => $values) {
                $stmt->bindValue(":$name", $values[0], $values[1]);
            }

            $stmt->execute();

            return $stmt->rowCount();
        }
    }

    public function delete(string $id) {
        $sql = "DELETE FROM Products
                WHERE product_id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindvalue(":id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }

}