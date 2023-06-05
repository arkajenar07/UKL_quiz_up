<?php
session_start();
include('db.php');

if(isset($_GET['playing'])){
    $id = $_GET['playing'];
}

if(isset($_GET['ques'])){
    $ques = $_GET['ques'];
}

if(isset($_GET['true'])){
    $true = $_GET['true'];
}

$display_ques = "SELECT * FROM `soal` WHERE id_kuis = $id";
$result_dis = mysqli_query($host, $display_ques);

$count_soal = mysqli_num_rows($result_dis);
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
    h1{
        font-size: 48px;
        text-align: center;
    }
    .option{
        width: 640px;
        height: 128px;
        font-family: 'Share Tech Mono', monospace;
        background-color: #FFFFFF;
        font-size: 32px;
        border: 2px solid #AD7BE9;
    }

    .option:hover{
        cursor: pointer;
    }
    .option-con{
        display: grid;
        grid-template-columns: auto auto;
        gap: 32px;
    }
    
</style>
<body>
    <?php echo $_SESSION['start']; ?>
    <form action="" method="post">
        <?php while($row_dis = mysqli_fetch_array($result_dis)){
            if($row_dis['nomor'] == $ques){?>
                <h1><?php echo $row_dis['pertanyaan'];?></h1>
            <?php if($row_dis['jenis_soal'] == "option"){ ?>
            <div class="option-con">
            <button type="submit" name="option1" class="option"><?php echo  $row_dis['option1']?></button>
            <button type="submit" name="option2" class="option"><?php echo  $row_dis['option2']?></button>
            <button type="submit" name="option3" class="option"><?php echo  $row_dis['option3']?></button>
            <button type="submit" name="option4" class="option"><?php echo  $row_dis['option4']?></button>
            
        <?php
        if(isset($_POST['option1'])){
            if($row_dis['jawaban_benar'] == 1){
                $true++;
            }
            $ques = $ques + 1;
            if($ques > $count_soal){
                
                echo "<script>
                window.location.href = 'finish.php?finish=$id&true=$true';
                </script>";
            } else{
                echo "<script>
                window.location.href = 'play.php?playing=$id&ques=$ques&true=$true';
                </script>";
            }
            
            
        }

        if(isset($_POST['option2'])){
            if($row_dis['jawaban_benar'] == 2){
                $true++;
            }
            $ques = $ques + 1;
            if($ques > $count_soal){
                echo "<script>
                window.location.href = 'finish.php?finish=$id&true=$true';
                </script>";
            } else{
                echo "<script>
                window.location.href = 'play.php?playing=$id&ques=$ques&true=$true';
                </script>";
            }
            
        }

        if(isset($_POST['option3'])){
            if($row_dis['jawaban_benar'] == 3){
                $true++;
            }
            $ques = $ques + 1;
            if($ques > $count_soal){
                echo "<script>
                window.location.href = 'finish.php?finish=$id&true=$true';
                </script>";
            } else{
                echo "<script>
                window.location.href = 'play.php?playing=$id&ques=$ques&true=$true';
                </script>";
            }
            
        }

        if(isset($_POST['option4'])){
            if($row_dis['jawaban_benar'] == 4){
                $true++;
            }
            $ques = $ques + 1;
            if($ques > $count_soal){
                echo "<script>
                window.location.href = 'finish.php?finish=$id&true=$true';
                </script>";
            } else{
                echo "<script>
                window.location.href = 'play.php?playing=$id&ques=$ques&true=$true';
                </script>";
            }
            
        }
        } 
                if($row_dis['jenis_soal'] == "truefalse"){ ?>
                <button type="submit" name="option1" class="option"><?php echo  $row_dis['option1']?></button>
                <button type="submit" name="option2" class="option"class="option"><?php echo  $row_dis['option2']?></button>
                
        <?php

        if(isset($_POST['option1'])){
            if($row_dis['jawaban_benar'] == 5){
                $true++;
            }
            $ques = $ques + 1;
            if($ques > $count_soal){
                echo "<script>
                window.location.href = 'finish.php?finish=$id&true=$true';
                </script>";
            } else{
                echo "<script>
                window.location.href = 'play.php?playing=$id&ques=$ques&true=$true';
                </script>";
            }
            
        }

        if(isset($_POST['option2'])){
            if($row_dis['jawaban_benar'] == 6){
                $true++;
            }
            $ques = $ques + 1;
            if($ques > $count_soal){
                echo "<script>
                window.location.href = 'finish.php?finish=$id&true=$true';
                </script>";
            } else{
                echo "<script>
                window.location.href = 'play.php?playing=$id&ques=$ques&true=$true';
                </script>";
            }
            
        }

        }?></div><?php
        
        }} 
        
        ?>
    </form>

</body>
</html>