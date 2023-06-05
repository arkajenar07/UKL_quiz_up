<?php
session_start();

include('db.php');

if(isset($_GET['play'])){
    $id = $_GET['play'];
}
$select_play = "SELECT * FROM `kuis` WHERE id_kuis = $id";
$result = mysqli_query($host, $select_play);
$row = mysqli_fetch_array($result);

$user = $_SESSION['username_email'];

$id_search = "SELECT * FROM `pengguna` WHERE username = '$user'";
$id_search_query = mysqli_query($host, $id_search);
$id_search_row = mysqli_fetch_array($id_search_query);
$id_user = $id_search_row['id_user'];

$sql_history = "SELECT * FROM `quiz_pengguna` WHERE id_user = $id_user AND id_kuis = $id ORDER BY tanggal_bermain ASC";
$query_history = mysqli_query($host, $sql_history);
$count_history = mysqli_num_rows($query_history);


date_default_timezone_set("Asia/Jakarta");
$start = date("H:i:s");

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
        flex-direction: column;
        align-items: center;

    }
    .creator{
        margin-bottom: 40px;
    }

    .count-ques{
        background-color: #FFFFFF;
        width: 160px;
        padding: 8px 16px 8px 16px ;
        border: 2px solid  #AD7BE9;
        border-radius: 16px;
        color: #AD7BE9;
        text-align: center;
        margin-left: 16px;
    }

    .history{
        margin-bottom: 32px;
        border: 2px solid #AD7BE9;
        padding: 8px;
        border-radius: 16px;
    }
    
    .title-history{
        margin-top: 32px;
        margin-bottom: 16px;
    }

    .playmenu{
        border: 2px solid  #AD7BE9;
        border-radius: 32px;
        width: 720px;
        margin-top: 64px;
        display: flex;
        flex-direction: column;
        align-items: center;
        
    }

    .info{
        margin-top: 32px;
        display: flex;

    }

    h1{
        font-size: 48px;
        margin-top: 32px;
        color: #3E54AC;
        text-align: center;
    }
    .quiz-info{
        background-color: #AD7BE9;        
        width: 400px;
        height: 116px;
        border-radius: 24px;
        outline: 2px solid  #AD7BE9;
        outline-offset: 8px;
        margin-top: 32px;
    }

    .quiz-info h2{
        font-size: 32px;
        margin-top: 16px;
        color: #FFFFFF;
        font-weight: 400;
        text-align: center;
    }

    .play-button{
        background-color: #694E8A;
        width: 240px;
        border-radius: 16px;
        margin-top: 32px;
        margin-bottom: 48px;
        font-family: 'Share Tech Mono', monospace;
        color: #FFFFFF;
        font-size: 32px;
        outline: 2px solid  #694E8A;
        transition: 0.2s;
    }

    .play-button:hover{
        outline-offset: 4px;
    }
</style>
<body>
    <form action="" method="post" class="playmenu" >
    <h1><?php echo $row['nama_kuis'];?></h1>
    <?php 
    $get_id_kategori = $row['id_kategori'];
    $select_category = "SELECT kategori.nama_kategori, kuis.id_kategori FROM kategori INNER JOIN kuis ON kategori.id_kategori = $get_id_kategori;";
    $result_category = mysqli_query($host, $select_category);
    $row_category = mysqli_fetch_array($result_category);
    ?>
    <div class="quiz-info">
    <h2><?php echo "CATEGORY: ".$row_category['nama_kategori']; ?></h2>
    <?php 
    $get_id_pembuat = $row['id_pembuat'];
    $select_pembuat = "SELECT pengguna.username, kuis.id_pembuat FROM pengguna INNER JOIN kuis ON pengguna.id_user = $get_id_pembuat;";
    $id_get = mysqli_query($host, $select_pembuat);
    $row_id = mysqli_fetch_array($id_get);?>

    <h2 class="creator" ><?php echo "CREATED BY: ".$row_id['username']; ?></h2>
    <?php
    $select_question = "SELECT * FROM soal WHERE id_kuis = $id";
    $res_sel = mysqli_query($host, $select_question);
    $count_ques = mysqli_num_rows($res_sel);
    ?>
    </div>
    <div class="info">
    <span class="count-ques"> <?php echo $count_ques." QUESTIONS"; ?></span>
    <span class="count-ques"> <?php echo strtoupper($row['level']); ?></span>
    </div>
    <button type="submit" name="play" class="play-button" >PLAY NOW</button>
    
    <?php

        if(isset($_POST['play'])){
            $_SESSION['start'] = $start;
            echo "<script>
                    window.location.href = 'play.php?playing=$id&ques=1&true=0';
                </script>";
        }

    ?>
</form>
<div class="history-con">
<h2 class="title-history" >QUIZ HISTORY</h2>
    <?php if($count_history > 0){
            while($row_history = mysqli_fetch_array($query_history)){ 
                $waktu_awal = date($row_history['waktu_start']);
                $waktu_akhir = date($row_history['waktu_finish']); // bisa juga waktu sekarang now()
        
                $awal = new DateTime($waktu_awal);
                $akhir = new DateTime($waktu_akhir);
                $durasi = $awal->diff($akhir);

                ?>
            <div class="history">
                <p><font style="color: #FFFFFF; background-color: #694E8A;" >DATE: </font><?php echo $row_history['tanggal_bermain']; ?></p>
                <p><font style="color: #694E8A">DURATION: </font><?php echo $durasi->format('%H hour(s) %i minute(s) %s detik'); ?></p>
                <p><font style="color: #694E8A" >SCORE: </font><?php echo $row_history['nilai']; ?></p>
            </div>
        <?php }}else{?>
            <div>
                <p>NO HISTORY</p>
            </div>
        <?php } ?>
    </div>
</body>
</html>