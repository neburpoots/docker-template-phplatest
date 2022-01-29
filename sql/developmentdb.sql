use developmentdb;

/* 






THIS FILE IS REDUNDANT PLEASE READ README 







*/

CREATE TABLE Products
(
product_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
name varchar(100) NOT NULL,
price FLOAT NOT NULL,
stock INT NOT NULL DEFAULT 10,
img varchar(200),
description varchar(200)
);

CREATE TABLE Roles
(
role_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
name varchar(50) NOT NULL
);

CREATE TABLE Users
(
user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
role_id INT NOT NULL,
name varchar(50) NOT NULL,
email varchar(50) NOT NULL,
password varchar(255) NOT NULL,
FOREIGN KEY (role_id) REFERENCES Roles(role_id)
);

CREATE TABLE Orders
(
order_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
user_id INT NOT NULL,
orderdate DATETIME NOT NULL,
FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

CREATE TABLE Order_Lines
(
order_line_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
order_id INT NOT NULL,
product_id INT NOT NULL,
quantity INT NOT NULL,
FOREIGN KEY (order_id) REFERENCES Orders(order_id),
FOREIGN KEY (product_id) REFERENCES Products(product_id)
);

/* Dummy products */
INSERT INTO developmentdb.Products (name, price, stock, img, description) 
VALUES ('MSI GeForce RTX 3090 SUPRIM X 24G Videokaart', 3599, 100, 'https://res.cloudinary.com/dg5wrkfe7/image/upload/v1638970171/1_MSI-GeForce-RTX-3090-SUPRIM-24G-Videokaart_unfm7i.jpg', 'This is a test description for the 3090.'),
VALUES ('Gigabyte GeForce RTX 3080 GAMING OC WATERFORCE WB 10G 2.0 Videokaart', 1999, 100, 'https://res.cloudinary.com/dg5wrkfe7/image/upload/v1638970171/2_Gigabyte-GeForce-RTX-3080-GAMING-OC-WATERFORCE-WB-10G-2-0-Videokaart_dujlid.jpg', 'This is a test description for the 3090.'),
VALUES ('Asus Geforce RTX 3070 ROG-STRIX-RTX3070-O8G-V2-GAMING Videokaart', 1599, 100, 'https://res.cloudinary.com/dg5wrkfe7/image/upload/v1638970171/1_Asus-Geforce-RTX-3070-ROG-STRIX-RTX3070-O8G-V2-GAMING-Videokaart_bzmfuy.jpg', 'This is a test description for the 3090.');

/*Dummy roles */
insert into developmentdb.Roles (role_id, name)
values  (1, 'Customer'),
        (2, 'Admin');


INSERT INTO Users (role_id, name, email, password)
    VALUES (2, 'Mark de Haan', 'mark@test.com', 'Welkom123!'),
    (1, 'Ruben Stoop', 'ruben@test.com', 'Admin123!');

INSERT INTO Orders (user_id, orderdate)
values  (1, '2021-12-08 14:00:39'),
        (1, '2021-08-08 14:00:42'),
        (2, '2021-05-08 14:00:47');

INSERT INTO Order_Lines (order_id, product_id, quantity)
            values  (1, 1, 2),
                    (1, 2, 1),
                    (2, 1, 3),
                    (3, 1, 1),
                    (3, 2, 1),
                    (3, 3, 1),
                    (2, 3, 1);
