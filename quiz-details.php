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

$id_user = $_SESSION["id_user"];

$sql_play = "SELECT * FROM `quiz_pengguna` WHERE id_kuis = $id";
$query_play = mysqli_query($host, $sql_play);
$count_play = mysqli_num_rows($query_play);

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
        margin-left: 32px;
        margin-bottom: 24px;
        
    }

    .history-con{
        display: grid;
        grid-template-columns: auto auto;
        gap: 32px;

    }

    .history{
        border: 2px solid #AD7BE9;
        padding: 8px;
        border-radius: 16px;
    }

    .history a{
        text-decoration: none;
    }

    .history a button{
        color: #B90000;
        font-size: 16px;
        background-color: #FFFFFF;
        font-family: 'Share Tech Mono', monospace;
        border: 2px solid  #B90000;
        border-radius: 16px;
        padding: 4px;
    }

    .no-history p{
        font-size: 32px;
        color: #AD7BE9;
    }
    
    .title-history{
        margin-top: 32px;
        margin-bottom: 16px;
    }

    .playmenu{
        border: 2px solid  #694E8A;
        border-radius: 32px;
        width: 720px;
        margin-top: 64px;
        display: flex;
        flex-direction: column;
        align-items: center;
        
    }

    .info-con{
        display: flex;
    }

    .info{
        margin-top: 32px;
        display: flex;
        flex-direction: column;

    }

    h1{
        font-size: 48px;
        padding-top: 16px;
        padding-bottom: 16px;
        color: #FFFFFF;
        background-color: #694E8A;
        width: 100%;
        font-weight: 550;
        border-radius: 24px 24px 0 0;
        text-align: center;
    }

    h2{
        text-align: center;
    }
    .quiz-info{
        background-color: #AD7BE9;        
        width: 400px;
        height: 148px;
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
        border: none;
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
        cursor: pointer;
    }

    p{
        margin-top: 16px;
        margin-bottom: 16px;
        font-size: 24px;
        background-color: #F5F5F5;
        padding: 8px;
        border-radius: 8px;
    }

    .del{
        margin-left: 50%;
        transform: translateX(-50%);
        width: 360px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .del .img-del{
        width: 32px;
        margin-left: 32px;
    }

    .all-link{
        width: 360px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
    }

    .all .img-del{
        width: 32px;
        margin-left: 32px;
    }

    .all{
        color: #B90000;
        font-size: 16px;
        background-color: #FFFFFF;
        font-family: 'Share Tech Mono', monospace;
        border: 2px solid  #B90000;
        border-radius: 16px;
        padding: 8px;
        text-decoration: none;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .back-button{
        background-color: #FFFFFF;
        margin-top: 64px;
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

    .back-button:hover{
        outline-offset: 4px;
        cursor: pointer;
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
    <div class="info-con">
    <div class="quiz-info">
    <h2><?php echo "CATEGORY: ".$row_category['nama_kategori']; ?></h2>
    <?php 
    $get_id_pembuat = $row['id_pembuat'];
    $select_pembuat = "SELECT pengguna.username, kuis.id_pembuat FROM pengguna INNER JOIN kuis ON pengguna.id_user = $get_id_pembuat;";
    $id_get = mysqli_query($host, $select_pembuat);
    $row_id = mysqli_fetch_array($id_get);?>

    <h2 class="creator" ><?php echo "CREATED BY: ".$row_id['username']; ?></h2>
    <?php
     $get_id_kelas = $row['id_kelas'];
     $select_kelas = "SELECT kelas.nama_kelas, kuis.id_kelas FROM kelas INNER JOIN kuis ON kuis.id_kelas = $get_id_kelas;";
     $name_get = mysqli_query($host, $select_kelas);
     $row_kelas = mysqli_fetch_array($name_get);

    $select_question = "SELECT * FROM soal WHERE id_kuis = $id";
    $res_sel = mysqli_query($host, $select_question);
    $count_ques = mysqli_num_rows($res_sel);
    ?>
    </div>
    <div class="info">
    <span class="count-ques"> <?php echo $count_ques." QUESTIONS"; ?></span>
    <span class="count-ques"> <?php echo "KELAS: ".$row_kelas['nama_kelas']; ?></span>
    <span class="count-ques"> <?php echo "LEVEL: ". strtoupper($row['level']); ?></span>
    </div>
    
    </div>
    <span class="count-ques"> <?php echo  $count_play." PLAYED"; ?></span>
</form>

<a href="page-mentor.php"><button class="back-button">FIND NEW QUIZ</button></a>

</body>
</html>