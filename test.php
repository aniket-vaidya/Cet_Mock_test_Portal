<?php include "config.php";

$test_id = $_GET['id'];
$res = $conn->query("SELECT * FROM questions WHERE test_id=$test_id");
$questions = [];
while($row = $res->fetch_assoc()){
    $questions[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>CET Exam</title>

<style>
body { font-family: Arial; display: flex; margin:0; }

/* LEFT PANEL */
.left {
    width: 70%;
    padding: 20px;
}

/* RIGHT PANEL */
.right {
    width: 30%;
    background: #f4f4f4;
    padding: 20px;
}

/* QUESTION BOX */
.qbox { display:none; }
.qbox.active { display:block; }

/* NAV BUTTONS */
.nav-btn {
    width:40px;height:40px;margin:5px;
    border:none;
    background:#ddd;
    cursor:pointer;
}

.answered { background: green; color:white; }
.not-answered { background: red; color:white; }

/* TIMER */
#timer { font-size:20px; color:red; }


body { background:#121212; color:white; }
.left { background:#181818; }
.right { background:#222; }

.nav-btn {
    background:#333;
    color:white;
}

.answered { background: green; }

</style>
</head>

<body>

<!-- LEFT SIDE -->
<div class="left">

<h3>Time Left: <span id="timer">90:00</span></h3>

<form id="testForm">

<?php foreach($questions as $index => $q){ ?>
<div class="qbox <?= $index==0 ? 'active' : '' ?>" id="q<?= $q['id'] ?>">

    <h4>Q<?= $index+1 ?>. <?= $q['question'] ?></h4>

    <input type="radio" name="q<?= $q['id'] ?>" value="A"> <?= $q['option_a'] ?><br>
    <input type="radio" name="q<?= $q['id'] ?>" value="B"> <?= $q['option_b'] ?><br>
    <input type="radio" name="q<?= $q['id'] ?>" value="C"> <?= $q['option_c'] ?><br>
    <input type="radio" name="q<?= $q['id'] ?>" value="D"> <?= $q['option_d'] ?><br>

</div>
<?php } ?>

<br>
<button type="button" onclick="submitTest()">Submit Test</button>

</form>
</div>

<!-- RIGHT SIDE -->
<div class="right">
<h3>Questions</h3>

<?php foreach($questions as $index => $q){ ?>
<button class="nav-btn" onclick="showQ(<?= $q['id'] ?>)" id="btn<?= $q['id'] ?>">
    <?= $index+1 ?>
</button>
<?php } ?>

</div>

<script>

// SWITCH QUESTION
function showQ(id){
    document.querySelectorAll(".qbox").forEach(q => q.classList.remove("active"));
    document.getElementById("q"+id).classList.add("active");
}

// COLOR CHANGE WHEN ANSWERED
document.querySelectorAll("input[type=radio]").forEach(el=>{
    el.addEventListener("change", function(){
        let qid = this.name.replace("q","");
        document.getElementById("btn"+qid).classList.add("answered");
    });
});

// TIMER
let time = 90*60;
setInterval(()=>{
    let m = Math.floor(time/60);
    let s = time%60;

    document.getElementById("timer").innerText = m+":"+s;

    time--;

    if(time <= 0){
        alert("Time Up!");
        submitTest();
    }
},1000);


// SUBMIT
function submitTest(){
    let formData = new FormData(document.getElementById("testForm"));

    fetch("submit.php?test_id=<?= $test_id ?>",{
        method:"POST",
        body:formData
    })
   .then(result_id=>{
    window.location.href="result.php?id="+result_id;
});
}

</script>

</body>
</html>