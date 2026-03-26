
<?php

$total = $result['total'];
$score = $result['score'];

$accuracy = ($score / $total) * 100;

// Weak sections
$weak_sections = [];

foreach($section_total as $sec => $total_q){
    $correct = $section_correct[$sec];

    $percent = ($correct / $total_q) * 100;

    if($percent < 50){
        $weak_sections[] = $sec;
    }
}

// Strong sections
$strong_sections = [];

foreach($section_total as $sec => $total_q){
    $correct = $section_correct[$sec];

    if(($correct / $total_q) * 100 > 75){
        $strong_sections[] = $sec;
    }
}
?>
<?php include "config.php";

$result_id = $_GET['id'];

$res = $conn->query("SELECT * FROM results WHERE id=$result_id");
$result = $res->fetch_assoc();

$answers = json_decode($result['answers'], true);
$test_id = $result['test_id'];

$qres = $conn->query("SELECT * FROM questions WHERE test_id=$test_id");

// SECTION ANALYSIS
$section_total = [];
$section_correct = [];

$questions = [];

while($q = $qres->fetch_assoc()){
    $questions[] = $q;

    $sec = $q['section'];

    if(!isset($section_total[$sec])){
        $section_total[$sec] = 0;
        $section_correct[$sec] = 0;
    }

    $section_total[$sec]++;

    if(isset($answers[$q['id']]) && $answers[$q['id']] == $q['correct_answer']){
        $section_correct[$sec]++;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Result</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body { background:#121212; color:white; font-family:Arial; }

.card {
    background:#1e1e1e;
    padding:15px;
    margin:10px;
    border-radius:10px;
}

.correct { color:lightgreen; }
.wrong { color:red; }

</style>
</head>

<body>

<h2>🎯 Score: <?= $result['score'] ?> / <?= $result['total'] ?></h2>

<!-- CHART -->

<div class="card">
<h3>🧠 AI Performance Analysis</h3>

<p>📊 Accuracy: <?= round($accuracy,2) ?>%</p>

<?php if($accuracy > 80){ ?>
    <p style="color:lightgreen;">🔥 Excellent Performance! You're CET ready.</p>
<?php } elseif($accuracy > 50){ ?>
    <p style="color:orange;">⚠️ Average performance. Improve weak areas.</p>
<?php } else { ?>
    <p style="color:red;">❌ Needs serious improvement.</p>
<?php } ?>

<p><b>💪 Strong Areas:</b> <?= implode(", ", $strong_sections) ?: "None" ?></p>
<p><b>📉 Weak Areas:</b> <?= implode(", ", $weak_sections) ?: "None" ?></p>

</div>
<canvas id="chart"></canvas>

<script>
let labels = <?= json_encode(array_keys($section_total)) ?>;
let data = <?= json_encode(array_values($section_correct)) ?>;

new Chart(document.getElementById("chart"), {
    type: "bar",
    data: {
        labels: labels,
        datasets: [{
            label: "Correct Answers",
            data: data
        }]
    }
});
</script>

<hr>

<h3>📊 Section Analysis</h3>

<?php foreach($section_total as $sec => $total){ ?>
<div class="card">
    <b><?= $sec ?></b><br>
    Correct: <?= $section_correct[$sec] ?> / <?= $total ?>
</div>
<?php } ?>

<hr>

<h3>📘 Detailed Solutions</h3>

<?php $i=1; foreach($questions as $q){ ?>

<div class="card">

<h4>Q<?= $i++ ?>. <?= $q['question'] ?></h4>

<?php
$user_ans = $answers[$q['id']] ?? "Not Answered";
$correct = $q['correct_answer'];

function show($l,$t,$u,$c){
    $class = "";
    if($l == $c) $class="correct";
    if($l == $u && $l != $c) $class="wrong";

    echo "<p class='$class'>($l) $t</p>";
}

show("A",$q['option_a'],$user_ans,$correct);
show("B",$q['option_b'],$user_ans,$correct);
show("C",$q['option_c'],$user_ans,$correct);
show("D",$q['option_d'],$user_ans,$correct);
?>
<a href="generate_pdf.php?id=<?= $result_id ?>" target="_blank">
    📄 Download PDF Report
</a>
<p><b>Your Answer:</b> <?= $user_ans ?></p>
<p><b>Correct Answer:</b> <?= $correct ?></p>

<p><b>Solution:</b> <?= $q['solution'] ?></p>
<a href="generate_pdf.php?id=<?= $result_id ?>" target="_blank">
    📄 Download PDF Report
</a>
</div>

<?php } ?>

</body>
</html>