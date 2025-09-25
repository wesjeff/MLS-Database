<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $minPrice = $_POST['minPrice'];
    $maxPrice = $_POST['maxPrice'];
    $minSize = $_POST['minSize'];
    $maxSize = $_POST['maxSize'];
    $sql = "SELECT L.mlsNumber, P.address, P.ownerName, P.price, B.type, B.size
            FROM Listings L
            JOIN Property P ON L.address = P.address
            JOIN BusinessProperty B ON P.address = B.address
            WHERE P.price BETWEEN $minPrice AND $maxPrice
            AND B.size BETWEEN $minSize AND $maxSize
            ORDER BY P.price DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<h1>Business Property Search Results</h1>";
        echo "<table border='1'><tr><th>MLS</th><th>Address</th><th>Owner</th><th>Price</th><th>Type</th><th>Size</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["mlsNumber"]."</td><td>".$row["address"]."</td><td>".$row["ownerName"]."</td><td>".$row["price"]."</td><td>".$row["type"]."</td><td>".$row["size"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h1>No matching business properties found</h1>";
    }
    $conn->close();
} else {
    echo '<h1>Search Business Properties</h1>
    <form method="post" action="">
        Minimum Price: <input type="number" name="minPrice" required><br>
        Maximum Price: <input type="number" name="maxPrice" required><br>
        Minimum Size (sqft): <input type="number" name="minSize" required><br>
        Maximum Size (sqft): <input type="number" name="maxSize" required><br>
        <input type="submit" value="Search">
    </form>';
}
?>
