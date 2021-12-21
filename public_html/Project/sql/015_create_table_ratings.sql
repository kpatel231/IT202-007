CREATE TABLE IF NOT EXISTS Ratings(
    id int AUTO_INCREMENT PRIMARY KEY
    item_id int,
    user_id int,
    rating int, 
    comment text,
    created created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(id)
