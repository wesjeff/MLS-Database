<?php
echo "<h1>Run SQL Query</h1>";

echo '<form method="post" action="query_result.php">
        SQL Query:<br>
        <textarea name="query" rows="5" cols="80" required></textarea><br>
        <input type="submit" value="Run Query">
      </form>';
?>
