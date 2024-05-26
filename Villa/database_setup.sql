CREATE DATABASE villadb;

ALTER TABLE properties
ADD description TEXT NOT NULL;


-- Insert values into the properties table
INSERT INTO properties (country, city, date, image, price, bedrooms, bathrooms, area, type) VALUES
('Albania', 'Tirana', '2024-03-21', './assets/images/City1/BedroomCity1.jpg', 99, 3, 2, 120, 'penthouse', 'description'),
('Switzerland', 'Bern', '2024-03-21', './assets/images/City1/CityHouse1.jpg', 45, 3, 2, 154, 'villa', 'description'),
('Kosovo', 'Prishtina', '2024-05-31', './assets/images/City1/SallonCity.jpg', 50, 3, 1, 162, 'apartment', 'description'),
('Austria', 'Wien', '2024-03-21', './assets/images/City2/SallonCity2.jpg', 100, 3, 3, 115, 'apartment', 'description'),
('France', 'Paris', '2024-03-21', './assets/images/City2/CityHouse2.jpg', 75, 4, 4, 124, 'villa', 'description'),
('Spain', 'Barcelona', '2024-03-21', './assets/images/City2/BedroomCity2.jpg', 100, 3, 3, 254, 'penthouse', 'description'),
('Croatia', 'Split', '2024-04-15', './assets/images/property-01.jpg', 500, 5, 5, 270, 'villa', 'description'),
('Slovenia', 'Ljubljana', '2024-04-15', './assets/images/property-02.jpg', 420, 2, 3, 115, 'penthouse', 'description'),
('Germany', 'Berlin', '2024-04-15', './assets/images/property-04.jpg', 200, 3, 4, 120, 'villa', 'description');

