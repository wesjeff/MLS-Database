USE mls;

-- Query 1: Find the addresses of all houses currently listed
SELECT h.address
FROM House h
JOIN Listings l ON h.address = l.address;

-- Query 2: Find the addresses and MLS numbers of all houses currently listed
SELECT h.address, l.mlsNumber
FROM House h
JOIN Listings l ON h.address = l.address;

-- Query 3: Find the addresses of all 3-bedroom, 2-bathroom houses currently listed
SELECT h.address, h.bedrooms, h.bathrooms
FROM House h
JOIN Listings l ON h.address = l.address
WHERE h.bedrooms = 3 AND h.bathrooms = 2;

-- Query 4: Find the addresses and prices of all 3-bedroom, 2-bathroom houses with prices in the range $100,000 to $250,000, in descending order of price
SELECT h.address, p.price, h.bedrooms, h.bathrooms
FROM House h
JOIN Listings l ON h.address = l.address
JOIN Property p ON h.address = p.address
WHERE h.bedrooms = 3 
  AND h.bathrooms = 2 
  AND p.price BETWEEN 100000 AND 250000
ORDER BY p.price DESC;

-- Query 5: Find the addresses and prices of all business properties that are advertised as office space in descending order of price
SELECT bp.address, p.price, bp.type AS propertyType
FROM BusinessProperty bp
JOIN Listings l ON bp.address = l.address
JOIN Property p ON bp.address = p.address
WHERE bp.type = 'office'
ORDER BY p.price DESC;

-- Query 6: Find all the ids, names and phones of all agents, together with the names of their firms and the dates when they started
SELECT a.agentId, a.name, a.phone, f.name AS firmName, a.dateStarted
FROM Agent a
JOIN Firm f ON a.firmId = f.id;

-- Query 7: Find all the properties currently listed by agent with id "1"
SELECT agentId, address
FROM Listings
WHERE agentId = 1;

-- Query 8: Find all Agent.name-Buyer.name pairs where the buyer works with the agent, sorted alphabetically by Agent.name
SELECT a.name AS AgentName, b.name AS BuyerName
FROM Agent a
JOIN Works_With w ON a.agentId = w.agentId
JOIN Buyer b ON w.buyerId = b.id
ORDER BY a.name;

-- Query 9: For each agent, find the total number of buyers currently working with that agent
SELECT agentId, COUNT(buyerId) AS buyerCount
FROM Works_With
GROUP BY agentId;

-- Query 10: For buyer with id "1", find all houses that meet the buyer's preferences, with results shown in descending order of price
SELECT 1 AS buyerId, h.address, p.price
FROM House h
JOIN Listings l ON h.address = l.address
JOIN Property p ON h.address = p.address
WHERE h.bedrooms >= (SELECT bedrooms FROM Buyer WHERE id = 1)
  AND h.bathrooms >= (SELECT bathrooms FROM Buyer WHERE id = 1)
  AND p.price BETWEEN (SELECT minimumPreferredPrice FROM Buyer WHERE id = 1) 
                  AND (SELECT maximumPreferredPrice FROM Buyer WHERE id = 1)
ORDER BY p.price DESC;