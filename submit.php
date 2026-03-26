<?php include "config.php";

$test_id = $_GET['test_id'];
$user_id = $_SESSION['user']['id'];

$score = 0;

// Store answers in array
$user_answers = [];

$res = $conn->query("SELECT * FROM questions WHERE test_id=$test_id");

while($q = $res->fetch_assoc()){
    $qid = "q".$q['id'];

    if(isset($_POST[$qid])){
        $user_ans = $_POST[$qid];
        $user_answers[$q['id']] = $user_ans;

        if($user_ans == $q['correct_answer']){
            $score += 2;
        }
    } else {
        $user_answers[$q['id']] = "Not Answered";
    }
}

$total = $res->num_rows * 2;

// Save result + answers
$conn->query("INSERT INTO results(user_id,test_id,score,total,answers) VALUES(
    $user_id,
    $test_id,
    $score,
    $total,
    '".json_encode($user_answers)."'
)");

$result_id = $conn->insert_id;

echo $result_id; // send result id instead of score
?>