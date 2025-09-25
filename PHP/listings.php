<?php
include 'db.php';

echo "<h1>House Listings</h1>";
$sql = "SELECT L.mlsNumber, P.address, P.ownerName, P.price, H.bedrooms, H.bathrooms, H.size
        FROM Listings L
        JOIN Property P ON L.address = P.address
        JOIN House H ON P.address = H.address";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  echo "<table border='1'><tr><th>MLS</th><th>Address</th><th>Owner</th><th>Price</th><th>Bedrooms</th><th>Bathrooms</th><th>Size</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["mlsNumber"]."</td><td>".$row["address"]."</td><td>".$row["ownerName"]."</td><td>".$row["price"]."</td><td>".$row["bedrooms"]."</td><td>".$row["bathrooms"]."</td><td>".$row["size"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "No houses found";
}

echo "<h1>Business Property Listings</h1>";
$sql = "SELECT L.mlsNumber, P.address, P.ownerName, P.price, B.type, B.size
        FROM Listings L
        JOIN Property P ON L.address = P.address
        JOIN BusinessProperty B ON P.address = B.address";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  echo "<table border='1'><tr><th>MLS</th><th>Address</th><th>Owner</th><th>Price</th><th>Type</th><th>Size</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["mlsNumber"]."</td><td>".$row["address"]."</td><td>".$row["ownerName"]."</td><td>".$row["price"]."</td><td>".$row["type"]."</td><td>".$row["size"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "No business properties found";
}

$conn->close();
?>
