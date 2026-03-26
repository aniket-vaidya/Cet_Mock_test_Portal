<?php include "../config.php"; ?>

<h2>👨‍💼 Admin Dashboard</h2>

<a href="upload.php">➕ Upload New Test</a>

<hr>

<h3>All Tests</h3>

<?php
$res = $conn->query("SELECT * FROM tests");

while($row = $res->fetch_assoc()){
    echo "
    <div style='padding:10px;border:1px solid #ccc;margin:5px'>
        <b>".$row['title']."</b><br>
        Test ID: ".$row['id']."
    </div>";
}
?>

<hr>

<h3>Results</h3>

<?php
$res = $conn->query("
    SELECT results.*, users.name 
    FROM results 
    JOIN users ON results.user_id = users.id
");

while($row = $res->fetch_assoc()){
    echo "
    <div style='padding:10px;border:1px solid #ccc;margin:5px'>
        ".$row['name']." → ".$row['score']."/".$row['total']."
    </div>";
}
?>