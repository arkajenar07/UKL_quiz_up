<?php
session_start();
include('db.php');
$user = $_SESSION['username_email'];
$time_start = $_SESSION['start'];
if(isset($_GET['finish'])){
    $id_kuis = $_GET['finish'];
}

if(isset($_GET['true'])){
    $true = $_GET['true'];
}

$id_search = "SELECT * FROM `pengguna` WHERE username = '$user'";
$id_search_query = mysqli_query($host, $id_search);
$id_search_row = mysqli_fetch_array($id_search_query);
$id_user = $id_search_row['id_user'];

$display_ques = "SELECT * FROM `soal` WHERE id_kuis = $id_kuis";
$result_dis = mysqli_query($host, $display_ques);

$count_soal = mysqli_num_rows($result_dis);
$wrong = $count_soal - $true;

$point_per_question = floor(100 / $count_soal); 
$wrong_point = $wrong * $point_per_question;
$nilai = 100 - $wrong_point;

$play_record = "INSERT INTO `quiz_pengguna`(`id_quizpengguna`, `id_user`, `id_kuis`, `tanggal_bermain`, `waktu_start`, `waktu_finish`, `nilai`) VALUES ('','$id_user','$id_kuis',now(),'$time_start',now(),$nilai)";
$result_play = mysqli_query($host, $play_record);

echo "U FINISH";

//
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="style.css">-->
    <title>Document</title>
</head>
<style>
    .nilai{
        accent-color: #AD7BE9;
    }
</style>
<body>
    <h1><?php echo "NILAI MU: ".$nilai." / ". 100; ?></h1>
    <button><a href="playmenu.php?play=<?php echo $id_kuis; ?>">PLAY AGAIN</a></button>
</body>
</html>