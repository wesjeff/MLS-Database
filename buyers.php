<?php
include 'db.php';

$sql = "SELECT * FROM Buyer ORDER BY name ASC";
$result = $conn->query($sql);

echo "<h1>Buyers</h1>";

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
              <th>Buyer ID</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Property Type</th>
              <th>Bedrooms</th>
              <th>Bathrooms</th>
              <th>Business Property Type</th>
              <th>Min Price</th>
              <th>Max Price</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["name"]."</td>
                <td>".$row["phone"]."</td>
                <td>".$row["propertyType"]."</td>
                <td>".$row["bedrooms"]."</td>
                <td>".$row["bathrooms"]."</td>
                <td>".$row["businessPropertyType"]."</td>
                <td>".$row["minimumPreferredPrice"]."</td>
                <td>".$row["maximumPreferredPrice"]."</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No buyers found";
}

$conn->close();
?>
