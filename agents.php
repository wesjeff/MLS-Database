<?php
include 'db.php';

$sql = "SELECT A.agentId, A.name AS agentName, A.phone, F.name AS firmName, F.address AS firmAddress, A.dateStarted
        FROM Agent A
        JOIN Firm F ON A.firmId = F.id
        ORDER BY A.name ASC";

$result = $conn->query($sql);

echo "<h1>Agents</h1>";

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>Agent ID</th><th>Name</th><th>Phone</th><th>Firm</th><th>Firm Address</th><th>Date Started</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["agentId"]."</td><td>".$row["agentName"]."</td><td>".$row["phone"]."</td><td>".$row["firmName"]."</td><td>".$row["firmAddress"]."</td><td>".$row["dateStarted"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "No agents found";
}

$conn->close();
?>
