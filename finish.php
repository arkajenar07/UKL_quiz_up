<?php
session_start();
include('db.php');
$time_start = $_SESSION['start'];

$id_user = $_SESSION["id_user"];

if(isset($_GET['finish'])){
    $id_kuis = $_GET['finish'];
}

if(isset($_GET['true'])){
    $true = $_GET['true'];
}

$display_ques = "SELECT * FROM `soal` WHERE id_kuis = $id_kuis";
$result_dis = mysqli_query($host, $display_ques);

$count_soal = mysqli_num_rows($result_dis);
$wrong = $count_soal - $true;

$point_per_question = floor(100 / $count_soal); 
$wrong_point = $wrong * $point_per_question;
$nilai = 100 - $wrong_point;

$play_record = "INSERT INTO `quiz_pengguna`(`id_quizpengguna`, `id_user`, `id_kuis`, `tanggal_bermain`, `waktu_start`, `waktu_finish`, `nilai`) VALUES ('','$id_user','$id_kuis',now(),'$time_start',now(),$nilai)";
$result_play = mysqli_query($host, $play_record);

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
        @import url('https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap');
    
    *{
        margin: 0;
        padding: 0;
    }
    
        /* Hide scrollbar for Chrome, Safari and Opera */
    body::-webkit-scrollbar {
      display: none;
    }
    
    html{
        scroll-behavior: smooth;
    
    }
    body{
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
        font-family: 'Share Tech Mono', monospace;
        display: flex;
        justify-content: center; 
        margin-top: ;
        
    }

    .finish-con{
        width: 720px;
        height: 560px;
        border:  6px solid #AD7BE9;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border-radius: 48px;
        margin-top: 128px;
    }

    h1{
        font-size: 48px;
        color:  #3E54AC;
        margin-bottom: 32px;
        
    }

    .play-button{
        background-color: #694E8A;
        width: 320px;
        height: 48px;
        border-radius: 16px;
        border: none;
        margin-bottom: 48px;
        font-family: 'Share Tech Mono', monospace;
        color: #FFFFFF;
        font-size: 32px;
        outline: 2px solid  #694E8A;
        transition: 0.2s;
    }

    .back-button{
        background-color: #FFFFFF;
        width: 320px;
        height: 48px;
        border-radius: 16px;
        border: none;
        margin-bottom: 48px;
        font-family: 'Share Tech Mono', monospace;
        color: #694E8A;
        font-size: 32px;
        outline: 2px solid  #694E8A;
        border: 2px solid  #694E8A;
        transition: 0.2s;
    }

    .play-button:hover{
        outline-offset: 4px;
        cursor: pointer;
    }

    .back-button:hover{
        outline-offset: 4px;
        cursor: pointer;
    }

</style>
<body>
    <div class="finish-con">
    <h1><?php echo "YOUR SCORE:  ".$nilai." / ". 100; ?></h1>
    <a href="playmenu.php?play=<?php echo $id_kuis; ?>"><button class="play-button">PLAY AGAIN</button></a>
    <a href="page.php"><button class="back-button">FIND NEW QUIZ</button></a>
    </div>
</body>
</html>