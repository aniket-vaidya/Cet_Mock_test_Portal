<?php include "config.php"; ?>

<h2>Available Tests</h2>

<?php
$res = $conn->query("SELECT * FROM tests");

while($row = $res->fetch_assoc()){
    echo "<a href='test.php?id=".$row['id']."'>Start ".$row['title']."</a><br>";
}
?>