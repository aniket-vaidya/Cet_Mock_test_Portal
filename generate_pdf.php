<?php
require('fpdf/fpdf.php');
include "config.php";

$result_id = $_GET['id'];

$res = $conn->query("SELECT * FROM results WHERE id=$result_id");
$result = $res->fetch_assoc();

$answers = json_decode($result['answers'], true);

$qres = $conn->query("SELECT * FROM questions WHERE test_id=".$result['test_id']);

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'CET Exam Result Report',0,1,'C');

$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,"Score: ".$result['score']." / ".$result['total'],0,1);

$pdf->Ln(5);

$i=1;

while($q = $qres->fetch_assoc()){

    $user_ans = $answers[$q['id']] ?? "Not Answered";

    $pdf->MultiCell(0,8,"Q$i. ".$q['question']);
    $pdf->MultiCell(0,8,"Your Answer: ".$user_ans);
    $pdf->MultiCell(0,8,"Correct Answer: ".$q['correct_answer']);
    $pdf->MultiCell(0,8,"Solution: ".$q['solution']);
    $pdf->Ln(5);

    $i++;
}

$pdf->Output();
?>