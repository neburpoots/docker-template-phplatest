<?php

require_once __DIR__ . '/../repositories/repository.php';
require_once __DIR__ . '/../models/User.php';


//CLASS SCAFFOLDS DATABASE AND SEEDS IT ACCORDINGLY
class DatabaseSeed extends Repository {

    function checkDatabase() {
        $sql = "SELECT *
                FROM INFORMATION_SCHEMA.TABLES
                WHERE TABLE_SCHEMA = 'developmentdb';";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $checkUser = false;
        $checkRoles = false;
        $checkProducts = false;
        $checkOrders = false;
        $checkOrder_Lines = false;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
            switch ($row['TABLE_NAME']) {
                case "Roles":
                    $checkRoles = true;
                    break;
                case "Users":
                    $checkUser = true;
                    break;
                case "Products":
                    $checkProducts = true;
                    break;
                case "Orders":
                    $checkOrders = true;
                    break;
                case "Order_Lines":
                    $checkOrder_Lines = true;
                    break;
            }
        }
            
        if(!$checkRoles) {
            $this->createTableRoles();
        }

        if(!$checkUser) {
            $this->createTableUsers();
        }

        if(!$checkProducts) {
            $this->createTableProducts();
        }

        if(!$checkOrders) {
            $this->createTableOrders();
        }

        if(!$checkOrder_Lines) {
            $this->createTableOrder_Lines();
        }
    }

    function createTableOrder_Lines() {
        try {
            $sql = "CREATE TABLE Order_Lines
                    (
                    order_line_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    order_id INT NOT NULL,
                    product_id INT NOT NULL,
                    quantity INT NOT NULL,
                    FOREIGN KEY (order_id) REFERENCES Orders(order_id),
                    FOREIGN KEY (product_id) REFERENCES Products(product_id)
                    );";

            $stmt = $this->connection->prepare($sql);

            $stmt->execute();

            $this->seedTableOrder_Lines();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    function seedTableOrder_Lines() {
        try {
            $sql = "INSERT INTO Order_Lines (order_id, product_id, quantity)
                    values  (1, 1, 2),
                            (1, 2, 1),
                            (2, 1, 3),
                            (3, 1, 1),
                            (3, 2, 1),
                            (3, 3, 1),
                            (2, 3, 1)";

            $stmt = $this->connection->prepare($sql);

            $stmt->execute();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    function createTableOrders() {
        try {
            $sql = "CREATE TABLE Orders
                    (
                    order_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    user_id INT NOT NULL,
                    orderdate DATETIME NOT NULL,
                    FOREIGN KEY (user_id) REFERENCES Users(user_id)
                    );";

            $stmt = $this->connection->prepare($sql);

            $stmt->execute();

            $this->seedTableOrders();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    function seedTableOrders() {
        try {
            $sql = "INSERT INTO Orders (user_id, orderdate)
            values  (1, '2021-12-08 14:00:39'),
                    (1, '2021-08-08 14:00:42'),
                    (2, '2021-05-08 14:00:47')";

            $stmt = $this->connection->prepare($sql);

            $stmt->execute();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    function createTableUsers() {
        try {
            $sql = "CREATE TABLE Users
                    (
                    user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    role_id INT NOT NULL,
                    name varchar(50) NOT NULL,
                    email varchar(50) NOT NULL,
                    password varchar(255) NOT NULL,
                    FOREIGN KEY (role_id) REFERENCES Roles(role_id)
                    );";

            $stmt = $this->connection->prepare($sql);

            $stmt->execute();

            $this->seedTableUsers();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    function seedTableUsers() {
        try {
            $sql = "INSERT INTO Users (role_id, name, email, password)
            VALUES (2, 'Mark de Haan', 'mark@test.com', :passwordOne),
            (1, 'Ruben Stoop', 'ruben@test.com', :passwordTwo);";

            $stmt = $this->connection->prepare($sql);

            //Sets hash for dummy user 1
            $user1 = new User();
            $user1->setPassword("Admin123!");

            //Sets hash for dummy user 2
            $user2 = new User();
            $user2->setPassword("Welkom123!");

            $stmt->bindValue(":passwordOne", $user1->getHash(), PDO::PARAM_STR);
            $stmt->bindValue(":passwordTwo", $user2->getHash(), PDO::PARAM_STR);


            $stmt->execute();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    function createTableProducts() {
        try {
            $sql = "CREATE TABLE Products
                    (
                    product_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    name varchar(100) NOT NULL,
                    price FLOAT NOT NULL,
                    stock INT NOT NULL DEFAULT 10,
                    img varchar(200),
                    description varchar(200)
                    );";

            $stmt = $this->connection->prepare($sql);

            $stmt->execute();

            $this->seedTableProducts();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    function seedTableProducts() {
        try {
            $sql = "INSERT INTO developmentdb.Products (name, price, stock, img, description) 
                    VALUES ('MSI GeForce RTX 3090 SUPRIM X 24G Videokaart', 3599, 100, 'https://res.cloudinary.com/dg5wrkfe7/image/upload/v1638970171/1_MSI-GeForce-RTX-3090-SUPRIM-24G-Videokaart_unfm7i.jpg', 'Dit is een beschrijving voor de 3090'),
                            ('Gigabyte GeForce RTX 3080 GAMING OC WATERFORCE WB 10G 2.0 Videokaart', 1999, 100, 'https://res.cloudinary.com/dg5wrkfe7/image/upload/v1638970171/2_Gigabyte-GeForce-RTX-3080-GAMING-OC-WATERFORCE-WB-10G-2-0-Videokaart_dujlid.jpg', 'Dit is een beschrijving voor de 3080'),
                            ('Asus Geforce RTX 3070 ROG-STRIX-RTX3070-O8G-V2-GAMING Videokaart', 1599, 100, 'https://res.cloudinary.com/dg5wrkfe7/image/upload/v1638970171/1_Asus-Geforce-RTX-3070-ROG-STRIX-RTX3070-O8G-V2-GAMING-Videokaart_bzmfuy.jpg', 'Dit is een beschrijving voor de 3070');
                            ";

            $stmt = $this->connection->prepare($sql);

            $stmt->execute();


        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    function createTableRoles() {
        try {
            $sql = "CREATE TABLE Roles
                    (
                    role_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    name varchar(50) NOT NULL
                    );";

            $stmt = $this->connection->prepare($sql);

            $stmt->execute();

            $this->seedTableRoles();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    function seedTableRoles() {
        /*Dummy roles */
        try {
            $sql = "insert into developmentdb.Roles (name)
                    values  ('Customer'),
                            ('Admin');";

            $stmt = $this->connection->prepare($sql);

            $stmt->execute();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }
}