<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $minPrice = $_POST['minPrice'];
    $maxPrice = $_POST['maxPrice'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];

    $sql = "SELECT L.mlsNumber, P.address, P.ownerName, P.price, H.bedrooms, H.bathrooms, H.size
            FROM Listings L
            JOIN Property P ON L.address = P.address
            JOIN House H ON P.address = H.address
            WHERE P.price BETWEEN $minPrice AND $maxPrice
            AND H.bedrooms = $bedrooms
            AND H.bathrooms = $bathrooms
            ORDER BY P.price DESC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h1>House Search Results</h1>";
        echo "<table border='1'><tr><th>MLS</th><th>Address</th><th>Owner</th><th>Price</th><th>Bedrooms</th><th>Bathrooms</th><th>Size</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["mlsNumber"]."</td><td>".$row["address"]."</td><td>".$row["ownerName"]."</td><td>".$row["price"]."</td><td>".$row["bedrooms"]."</td><td>".$row["bathrooms"]."</td><td>".$row["size"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h1>No matching houses found</h1>";
    }
    $conn->close();
} else {
    echo '<h1>Search Houses</h1>
    <form method="post" action="">
        Minimum Price: <input type="number" name="minPrice" required><br>
        Maximum Price: <input type="number" name="maxPrice" required><br>
        Bedrooms: <input type="number" name="bedrooms" required><br>
        Bathrooms: <input type="number" name="bathrooms" required><br>
        <input type="submit" value="Search">
    </form>';
}
?>
