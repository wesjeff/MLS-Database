<?php
include 'db.php';

echo "<h1>Query Results</h1>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = $_POST['query'];
    $result = $conn->query($query);
    if ($result) {
        if ($result instanceof mysqli_result && $result->num_rows > 0) {
            echo "<table border='1'><tr>";
            $fields = $result->fetch_fields();
            foreach ($fields as $field) {
                echo "<th>".$field->name."</th>";
            }
            echo "</tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $col) {
                    echo "<td>".$col."</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } elseif ($conn->affected_rows >= 0) {
            echo "Query executed successfully.";
        } else {
            echo "Query returned no results.";
        }
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
} else {
    echo "No query was submitted.";
}
echo '<p><a href="query.php">Back to Query Page</a></p>';
?>
