CREATE DATABASE classified_ads;

USE classified_ads;

CREATE TABLE category (id INT NOT NULL AUTO_INCREMENT,name VARCHAR(30) NOT NULL,PRIMARY KEY (id));

CREATE TABLE subcategory (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(30),
    category_id INT,
    PRIMARY KEY (id),
    INDEX category_ind (category_id),
    FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE CASCADE
);

INSERT INTO category (name) VALUES
    ('Vehicles'),('Property'),('Electronics & Computers'),
    ('Home, Garden & Tools'),('Hobbies & Interests'),('Sports & Outdoors');

INSERT INTO subcategory (category_id, name) VALUES
    (1, 'Cars'),
    (1, 'Car Parts & Accessories'),
    (1, 'Motorcycles'),
    (1, 'Trucks'),
    (2, 'Houses & Flats for rent'),
    (2, 'Houses & Flats for sale'),
    (2, 'Land'),
    (3, 'Cell Phones'),
    (3, 'TV, Audio & Visual'),
    (3, 'Computers & Laptops'),
    (4, 'Furniture & Decor'),
    (4, 'Tools'),
    (4, 'Garden'),
    (5, 'Toys, Games & Remote Control'),
    (5, 'Musical Instruments'),
    (6, 'Outdoor & Sports Equipment'),
    (6, 'Bicycles'),
    (6, 'Gym & Fitness');
