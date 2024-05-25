-- Users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    salt VARCHAR(255) NOT NULL
);

-- Properties Table
CREATE TABLE properties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    country VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    image VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    bedrooms INT NOT NULL,
    bathrooms INT NOT NULL,
    area INT NOT NULL,
    type VARCHAR(50) NOT NULL
);

-- Insert values into the properties table
INSERT INTO properties (country, city, date, image, price, bedrooms, bathrooms, area, type) VALUES
('Albania', 'Tirana', '2024-03-21', './assets/images/City1/BedroomCity1.jpg', 99, 3, 2, 120, 'penthouse'),
('Switzerland', 'Bern', '2024-03-21', './assets/images/City1/CityHouse1.jpg', 45, 3, 2, 154, 'villa'),
('Kosovo', 'Prishtina', '2024-05-31', './assets/images/City1/SallonCity.jpg', 50, 3, 1, 162, 'apartment'),
('Austria', 'Wien', '2024-03-21', './assets/images/City2/SallonCity2.jpg', 100, 3, 3, 115, 'apartment'),
('France', 'Paris', '2024-03-21', './assets/images/City2/CityHouse2.jpg', 75, 4, 4, 124, 'villa'),
('Spain', 'Barcelona', '2024-03-21', './assets/images/City2/BedroomCity2.jpg', 100, 3, 3, 254, 'penthouse'),
('Croatia', 'Split', '2024-04-15', './assets/images/property-01.jpg', 500, 5, 5, 270, 'villa'),
('Slovenia', 'Ljubljana', '2024-04-15', './assets/images/property-02.jpg', 420, 2, 3, 115, 'penthouse'),
('Germany', 'Berlin', '2024-04-15', './assets/images/property-04.jpg', 200, 3, 4, 120, 'villa');

-- bookings table
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    property_id INT NOT NULL,
    arrival_date DATE NOT NULL,
    departure_date DATE NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    payment_method VARCHAR(255) NOT NULL,
    comment TEXT,
    total_price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (property_id) REFERENCES properties(id)
);
-- ratings
CREATE TABLE ratings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    property_id INT NOT NULL,
    rating INT NOT NULL,
    UNIQUE KEY unique_rating (user_id, property_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (property_id) REFERENCES properties(id)
);