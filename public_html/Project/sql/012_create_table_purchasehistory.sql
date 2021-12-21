CREATE TABLE IF NOT EXISTS OrderItems(
    id int AUTO_INCREMENT PRIMARY KEY,
    order_id int,
    item_id int,
    quantity int,
    unit_price int,
    FOREIGN KEY (order_id) REFERENCES Users(id),
    FOREIGN KEY (item_id) REFERENCES Products(id)
)