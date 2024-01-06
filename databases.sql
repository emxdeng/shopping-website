-- The code is referencing the database from AWS Cloud9, but just adding this file for TA reference.

CREATE DATABASE uts;
use uts;

DROP TABLE IF EXISTS items, cart_items;

CREATE TABLE items (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    price FLOAT NOT NULL,
    category VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,
    details VARCHAR(255) NOT NULL,
    stock INT NOT NULL
);

CREATE TABLE cart_items (
  item_id INT NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  qtyOrdered INT NOT NULL,
  stock INT NOT NULL
);


--FOOD & DRINK
--Frozen Food
INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Frozen Pizza', 8.99, 'Frozen Food', '/img/pizza.jpg', 'Pepperoni and cheese', 0);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Frozen Vegetables', 2.99, 'Frozen Food', '/img/frozenveg.png', 'Mixed vegetables', 50);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Frozen Chicken Nuggets', 6.99, 'Frozen Food', '/img/chicken.png', '1 lb bag', 50);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Frozen Fruit', 3.99, 'Frozen Food', '/img/frozenfruit.png', 'Assorted berries', 35);

--Fresh Food
INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Organic Apples', 2.49, 'Fresh Food', '/img/apples.png', 'Pack of 6 apples', 40);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Fresh Salmon Fillet', 12.99, 'Fresh Food', '/img/salmon.png', 'Wild caught, 8 oz', 38);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Organic Carrots', 1.99, 'Fresh Food', '/img/carrots.png', '1 lb bag', 25);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Fresh Bread', 4.99, 'Fresh Food', '/img/bread.png', 'Sourdough loaf', 30);

--Beverages
INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Coca-Cola', 1.99, 'Beverages', '/img/cola.png', '12 fl oz can', 30);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Orange Juice', 3.99, 'Beverages', '/img/orangejuice.png', '59 fl oz carton', 30);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Coffee Beans', 9.99, 'Beverages', '/img/coffee.png', '12 oz bag', 22);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Green Tea', 2.99, 'Beverages', '/img/tea.png', '20 ct box', 35);

--HEALTH & BEAUTY
--Health
INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Band-Aids', 4.99, 'Health', '/img/bandaid.png', 'Pack of 30', 0);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Hand Sanitizer', 3.99, 'Health', '/img/handsani.png', '8 fl oz bottle', 20);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Multivitamins', 9.99, 'Health', '/img/vitamin.png', '60 ct bottle', 35);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Pain Reliever', 5.99, 'Health', '/img/advil.png', '24 ct box', 30);

-- Beauty
INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Lip Balm', 2.49, 'Beauty', '/img/lipbalm.png', '0.15 oz tube', 30);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Foundation', 12.99, 'Beauty', '/img/foundation.png', '30 ml bottle', 35);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Mascara', 7.99, 'Beauty', '/img/mascara.png', '0.3 oz tube', 25);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Eyeliner', 5.49, 'Beauty', '/img/eyeliner.png', '0.1 oz tube', 40);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Blush', 9.99, 'Beauty', '/img/blush.png', '0.2 oz jar', 30);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Makeup Remover', 6.99, 'Beauty', '/img/remover.png', '8 fl oz bottle', 35);


-- Personal Care
INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Conditioner', 4.99, 'Personal Care', '/img/conditioner.png', '8 fl oz bottle', 40);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Deodorant', 3.99, 'Personal Care', '/img/deodorant.png', '2.6 oz stick', 40);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Mouthwash', 6.99, 'Personal Care', '/img/mouthwash.png', '16 fl oz bottle', 45);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Hair Brush', 12.99, 'Personal Care', '/img/brush.png', 'Boar bristle', 40);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Razors', 9.99, 'Personal Care', '/img/razor.png', 'Pack of 10', 30);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Body Wash', 7.99, 'Personal Care', '/img/bodywash.png', '12 fl oz bottle', 25);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Facial Cleanser', 9.99, 'Personal Care', '/img/facialcleanser.png', '6 fl oz bottle', 45);

-- PETS
-- Cat Food
INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Dry Cat Food', 18.99, 'Cat Food', '/img/catdry.png', '5 lb bag', 40);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Treats for Cats', 4.99, 'Cat Food', '/img/cattreat.png', '4 oz bag', 45);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Wet Cat Food Variety Pack', 12.99, 'Cat Food', '/img/catwet.png', '24 cans of assorted flavors', 45);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Grain-Free Cat Food', 23.99, 'Cat Food', '/img/grainfree.png', '5 lb bag of salmon flavor', 30);


-- Dog Food
INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Dry Dog Food', 29.99, 'Dog Food', '/img/dogdry.png', '15 lb bag', 40);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Dog Treats', 5.99, 'Dog Food', '/img/dogtreat.png', '6 oz bag', 25);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Wet Dog Food Variety Pack', 16.99, 'Dog Food', '/img/dogwet.png', '24 cans of assorted flavors', 35);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Premium Dog Food', 44.99, 'Dog Food', '/img/dogpremium.png', '20 lb bag of lamb and rice flavor', 30);


-- Other Pet Items
INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Pet Toys', 7.99, 'Other Pet Items', '/img/toys.png', 'Set of 3', 50);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Dog Shampoo', 8.99, 'Other Pet Items', '/img/dogshampoo.png', '16 fl oz bottle', 35);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Pet Carrier', 29.99, 'Other Pet Items', '/img/carrier.png', 'For small dogs and cats', 25);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Scratching Post', 19.99, 'Other Pet Items', '/img/scratchingpost.png', 'For cats', 30);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Cat Litter', 12.99, 'Other Pet Items', '/img/litter.png', '20 lb bag', 45);



--FURNITURE
INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Bathroom Cabinet', 149.99, 'Bathroom', '/img/bathroom_cabinet.png', 'Modern bathroom cabinet with storage shelves.', 20);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Bathroom Shelf', 39.99, 'Bathroom', '/img/bathroom_shelf.png', 'Space-saving bathroom shelf for storage.', 20);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Living Room Sofa', 599.99, 'Living Room', '/img/living_room_sofa.png', 'Comfortable sofa for your living room.', 25);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Living Room Coffee Table', 129.99, 'Living Room', '/img/living_room_coffee_table.png', 'Modern coffee table for your living room.', 25);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Kitchen Table', 199.99, 'Kitchen', '/img/kitchen_table.png', 'Stylish wooden kitchen table with four chairs.', 28);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Kitchen Chair', 79.99, 'Kitchen', '/img/kitchen_chair.png', 'Comfortable chair for your kitchen.', 28);

--CLOTHES
INSERT INTO items (name, price, category, image, details, stock)
VALUES ('T-Shirt', 19.99, 'Tops', '/img/tshirt.png', 'Casual cotton t-shirt in various colors.', 20);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Blouse', 29.99, 'Tops', '/img/blouse.png', 'Elegant blouse for a stylish look.', 20);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Jeans', 49.99, 'Bottoms', '/img/jeans.png', 'Classic denim jeans for everyday wear.', 45);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Shorts', 34.99, 'Bottoms', '/img/shorts.png', 'Casual shorts for warm weather.', 45);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Winter Jacket', 89.99, 'Outerwear', '/img/winter_jacket.png', 'Warm and stylish winter jacket.', 32);

INSERT INTO items (name, price, category, image, details, stock)
VALUES ('Denim Jacket', 79.99, 'Outerwear', '/img/denim_jacket.png', 'Classic denim jacket for versatile styling.', 32);
