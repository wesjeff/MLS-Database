DROP DATABASE IF EXISTS mls;
CREATE DATABASE mls;
USE mls;

CREATE TABLE Property (
    address VARCHAR(50) PRIMARY KEY,
    ownerName VARCHAR(30) NOT NULL,
    price INTEGER NOT NULL
);

CREATE TABLE House (
    bedrooms INTEGER NOT NULL,
    bathrooms INTEGER NOT NULL,
    size INTEGER NOT NULL,
    address VARCHAR(50) PRIMARY KEY,
    FOREIGN KEY (address) REFERENCES Property(address)
);

CREATE TABLE BusinessProperty (
    type CHAR(20) NOT NULL,
    size INTEGER NOT NULL,
    address VARCHAR(50) PRIMARY KEY,
    FOREIGN KEY (address) REFERENCES Property(address)
);

CREATE TABLE Firm (
    id INTEGER PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    address VARCHAR(50) NOT NULL
);

CREATE TABLE Agent (
    agentId INTEGER PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    phone CHAR(12) NOT NULL,
    firmId INTEGER NOT NULL,
    dateStarted DATE NOT NULL,
    FOREIGN KEY (firmId) REFERENCES Firm(id)
);

CREATE TABLE Listings (
    mlsNumber INTEGER PRIMARY KEY,
    address VARCHAR(50) NOT NULL,
    agentId INTEGER NOT NULL,
    dateListed DATE NOT NULL,
    FOREIGN KEY (address) REFERENCES Property(address),
    FOREIGN KEY (agentId) REFERENCES Agent(agentId)
);

CREATE TABLE Buyer (
    id INTEGER PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    phone CHAR(12) NOT NULL,
    propertyType CHAR(20) NOT NULL,
    bedrooms INTEGER,
    bathrooms INTEGER,
    businessPropertyType CHAR(20),
    minimumPreferredPrice INTEGER NOT NULL,
    maximumPreferredPrice INTEGER NOT NULL
);

CREATE TABLE Works_With (
    buyerId INTEGER,
    agentId INTEGER,
    PRIMARY KEY (buyerId, agentId),
    FOREIGN KEY (buyerId) REFERENCES Buyer(id),
    FOREIGN KEY (agentId) REFERENCES Agent(agentId)
);

INSERT INTO Property (address, ownerName, price) VALUES
('123 Oak Street', 'John Smith', 150000),
('456 Pine Avenue', 'Mary Johnson', 225000),
('789 Maple Drive', 'Bob Wilson', 180000),
('321 Cedar Lane', 'Sarah Davis', 300000),
('654 Birch Road', 'Mike Brown', 120000),
('987 Elm Street', 'Lisa Garcia', 275000),
('147 Walnut Way', 'Tom Anderson', 350000),
('258 Ash Boulevard', 'Carol White', 200000);

INSERT INTO House (bedrooms, bathrooms, size, address) VALUES
(3, 2, 1500, '123 Oak Street'),
(4, 3, 2200, '456 Pine Avenue'),
(3, 2, 1800, '789 Maple Drive'),
(5, 4, 3000, '321 Cedar Lane'),
(2, 1, 1000, '654 Birch Road');

INSERT INTO BusinessProperty (type, size, address) VALUES
('office', 2500, '987 Elm Street'),
('retail', 1800, '147 Walnut Way'),
('warehouse', 5000, '258 Ash Boulevard');

INSERT INTO Firm (id, name, address) VALUES
(1, 'Premier Realty', '100 Main Street'),
(2, 'Elite Properties', '200 First Avenue'),
(3, 'Sunset Real Estate', '300 Second Street'),
(4, 'Metro Properties', '400 Third Avenue'),
(5, 'Valley Realty Group', '500 Fourth Street');

INSERT INTO Agent (agentId, name, phone, firmId, dateStarted) VALUES
(1, 'Alice Cooper', '555-123-4567', 1, '2020-01-15'),
(2, 'David Miller', '555-234-5678', 1, '2019-03-20'),
(3, 'Emma Taylor', '555-345-6789', 2, '2021-06-10'),
(4, 'Frank Wilson', '555-456-7890', 2, '2018-11-05'),
(5, 'Grace Lee', '555-567-8901', 3, '2022-02-28'),
(6, 'Henry Clark', '555-678-9012', 3, '2020-08-12'),
(7, 'Ivy Martinez', '555-789-0123', 4, '2019-12-03');

INSERT INTO Listings (mlsNumber, address, agentId, dateListed) VALUES
(1001, '123 Oak Street', 1, '2024-01-10'),
(1002, '456 Pine Avenue', 1, '2024-01-15'),
(1003, '789 Maple Drive', 2, '2024-01-20'),
(1004, '321 Cedar Lane', 3, '2024-02-01'),
(1005, '654 Birch Road', 2, '2024-02-05'),
(1006, '987 Elm Street', 4, '2024-02-10'),
(1007, '147 Walnut Way', 5, '2024-02-15'),
(1008, '258 Ash Boulevard', 3, '2024-02-20');

INSERT INTO Buyer (id, name, phone, propertyType, bedrooms, bathrooms, businessPropertyType, minimumPreferredPrice, maximumPreferredPrice) VALUES
(1, 'Robert Johnson', '555-111-2222', 'house', 3, 2, NULL, 100000, 200000),
(2, 'Jennifer Davis', '555-333-4444', 'house', 4, 3, NULL, 200000, 300000),
(3, 'Michael Chen', '555-555-6666', 'business', NULL, NULL, 'office', 250000, 400000),
(4, 'Amanda Rodriguez', '555-777-8888', 'house', 2, 1, NULL, 80000, 150000),
(5, 'Steven Williams', '555-999-0000', 'business', NULL, NULL, 'retail', 150000, 250000),
(6, 'Karen Thompson', '555-222-3333', 'house', 3, 2, NULL, 150000, 250000),
(7, 'Daniel Moore', '555-444-5555', 'house', 5, 4, NULL, 280000, 400000);

INSERT INTO Works_With (buyerId, agentId) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 4),
(4, 2),
(5, 5),
(6, 1),
(7, 3),
(2, 6),
(3, 7);