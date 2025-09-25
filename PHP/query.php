<?php
include 'db.php';

echo "<h1>Run SQL Query</h1>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = $_POST['query'];
    $result = $conn->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            $fields = $result->fetch_fields();
            echo "<tr>";
            foreach ($fields as $field) {
                echo "<th>".$field->name."</th>";
            }
            echo "</tr>";
            $result->data_seek(0);
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
    echo '<form method="post" action="">
            SQL Query:<br>
            <textarea name="query" rows="5" cols="80" required></textarea><br>
            <input type="submit" value="Run Query">
          </form>';
}
?>
