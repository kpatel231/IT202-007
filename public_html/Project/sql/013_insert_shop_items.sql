INSERT INTO Products (id, name, description, category, stock, cost, visibility, image) VALUES
(1, "Wireless Headphones", "Headphones that connect via bluetooth", "Electronics", 9999999, 5, "True", ""),
(2, "50 inch Insignia TV", "A TV with 4k display and top sound", "Electronics", 9999999, 15, "True", ""),
(4, "Electric Toothbrush", "A toothbrush that when someone powers on it brushes someone teeth by itself", "Electronics", 9999999, 2, "True", ""),
(5,"Samsung Galaxy S10", "A phone with Dynamic AMOLED Infinty-O Display with a battery capacity of 3400mAh", "Electronics", 9999999, 5, "True", ""),
(6, "Comb", "Use this item to style your hair the best way it can", "Hair Products", 9999999,  1, "True", ""),
(7, "USB C Headphone Adapter", "A item a person can use to plug in thier headphones if they have a phone, laptop, or ipad with a USB C port", "Accessories", 9999999, 1, "True", ""),
(8, "Apple Ipad", "The Latest Model of the Apple IPAD with a fast processor and bigger display", "Electronics", 9999999, 1, "True", ""),
(9, "Macbook USB C Charger", "A replacement charger with fast charging capabilties and with a USB C charger", "Accessories", 9999999, 1, "True", ""),
(10,"Call of Duty Vanguard", "The Latest Installment of the Call of Duty with new guns and new maps everyone could play.", "Games", 9999999, 1, "True",""),
(11, "King Shark Action Figure", "From The Suicide Squad Movie A King Shark Action Figure", "Toys", 9999999, 50, "True", ""),
(12, "Avenger Endgame DVD", "Buy the New Avengers Movie in DVD", "DVD", 9999999, 100, "True", ""),
(13, "AMC Gift Cards", "Buy this item so you can get discounted tickets whenever you go to the movies", "Gift Cards", 9999999, 5, "True", ""),
(14, "Walmart Gift Cards", "Buy this item so you can get up to whatever you like at Walmart", "Gift Cards", 9999999, 5, "True", ""),
(15, "Spiderman Far From Home DVD", "Buy the New Spiderman Movie in DVD", "DVD", 9999999, 100, "True", ""),
(16, "Spiderman Homecoming DVD", "Buy the Fist Spiderman Movie in the Marvel Franchise on DVD", "DVD", 9999999, 100, "True", "")
ON DUPLICATE KEY UPDATE modified = CURRENT_TIMESTAMP()


