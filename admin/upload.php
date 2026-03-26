<?php 
include "../config.php";

if(isset($_POST['upload'])){

    $title = $conn->real_escape_string($_POST['title']);

    // Check file
    if($_FILES['file']['error'] != 0){
        echo "<p style='color:red;'>❌ File upload failed!</p>";
        exit;
    }

    $file = $_FILES['file']['tmp_name'];
    $json = file_get_contents($file);
    $data = json_decode($json, true);

    // Validate JSON
    if(!$data){
        echo "<p style='color:red;'>❌ Invalid JSON format!</p>";
        exit;
    }

    // Insert test
    $conn->query("INSERT INTO tests(title) VALUES('$title')");
    $test_id = $conn->insert_id;

    // Insert questions
    foreach($data as $q){

        // Handle missing section (fallback)
        $section = isset($q['section']) ? $conn->real_escape_string($q['section']) : "General";

        $question = $conn->real_escape_string($q['question']);
        $optA = $conn->real_escape_string($q['options']['A']);
        $optB = $conn->real_escape_string($q['options']['B']);
        $optC = $conn->real_escape_string($q['options']['C']);
        $optD = $conn->real_escape_string($q['options']['D']);
        $correct = $conn->real_escape_string($q['correct_answer']);
        $solution = $conn->real_escape_string($q['solution']);

        $conn->query("INSERT INTO questions(
            test_id,question,option_a,option_b,option_c,option_d,correct_answer,solution,section
        ) VALUES(
            $test_id,
            '$question',
            '$optA',
            '$optB',
            '$optC',
            '$optD',
            '$correct',
            '$solution',
            '$section'
        )");
    }

    echo "<h3 style='color:green;'>✅ Test Uploaded Successfully!</h3>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Upload Test</title>

<style>
body {
    font-family: Arial;
    background: #121212;
    color: white;
    text-align: center;
}

.box {
    background: #1e1e1e;
    padding: 20px;
    margin: 50px auto;
    width: 300px;
    border-radius: 10px;
}

input, button {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
}

button {
    background: green;
    color: white;
    border: none;
    cursor: pointer;
}
</style>
</head>

<body>

<div class="box">

<h2>📤 Upload Test</h2>

<form method="POST" enctype="multipart/form-data">
    
    <input type="text" name="title" placeholder="Enter Test Title" required>

    <input type="file" name="file" accept=".json" required>

    <button name="upload">Upload Test</button>

</form>

<br>

<a href="dashboard.php" style="color:lightblue;">⬅ Back to Dashboard</a>

</div>

</body>
</html>