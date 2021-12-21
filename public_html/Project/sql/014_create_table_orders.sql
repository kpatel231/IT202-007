CREATE TABLE IF NOT EXISTS Orders(
    id int AUTO_INCREMENT PRIMARY KEY,
    user_id int,
    total_price int, 
    address text,
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    payment_method text,
    FOREIGN KEY (user_id) REFERENCES Users(id)
)