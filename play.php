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
        
        
    }

    form{
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .title-con{
        background-color: #AD7BE9;
        width: 95%;
        max-width: 100%;
        height: 280px;
        padding: 32px;
        border-radius: 0 0 32px 32px;
        margin-bottom: 128px
        
    }

    .title-con h1{
        text-align: center;
        margin-bottom: 16px;
        color: #fff;
        font-weight: 450;
    }

    .title{
        background-color: #FFFFFF;
        height: 320px;
        width: 75%;
        border: 8px solid #AD7BE9;
        border-radius: 32px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 50%;
        transform: translateX(-50%);
        box-shadow: 0px 10px 12px rgb(217, 217, 217);

    }
    .title .question-display{
        font-size: 32px;
        text-align: center;
        color: #AD7BE9;
    }


    .option{
        width: 800px;
        height: 160px;
        font-family: 'Share Tech Mono', monospace;
        background-color: #FFFFFF;
        font-size: 32px;
        color: #694E8A;
        border: 8px solid #694E8A;
        border-radius: 48px;
        transition: 0.2s;
        box-shadow: 0px 10px 12px rgb(217, 217, 217);
    }

    .option:hover{
        cursor: pointer;
        background-color: #AD7BE9;
        color: #FFFFFF;

    }
    .option-con{
        display: grid;
        grid-template-columns: auto auto;
        gap: 32px;
    }

    .center{
        display: flex;
        justify-content: center;
    }

</style>
<body>
    
    <form action="" method="post">
        <?php while($row_dis = mysqli_fetch_array($result_dis)){
            if($row_dis['nomor'] == $ques){?>
                
                <div class="title-con"><h1><?php echo "QUESTION NUMBER: ".$ques ;?></h1><div class="title"><h1 class="question-display"><?php echo $row_dis['pertanyaan'];?></h1></div></div> 
            <?php if($row_dis['jenis_soal'] == "option"){ ?>
            <div class="center">
                <div class="option-con">
                    <button type="submit" name="option1" class="option" id="opt1" ><?php echo  $row_dis['option1']?></button>
                    <button type="submit" name="option2" class="option" id="opt2"><?php echo  $row_dis['option2']?></button>
                    <button type="submit" name="option3" class="option" id="opt3"><?php echo  $row_dis['option3']?></button>
                    <button type="submit" name="option4" class="option" id= "opt4"><?php echo  $row_dis['option4']?></button>
                </div>
            </div>
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

        }?>
        <?php
        
        }} 
        
        ?>
    </form>

</body>
</html>