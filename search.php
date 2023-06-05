<?php
session_start();

include("db.php");

$search_result = $_SESSION['searchData'];
$sql_search = "SELECT * FROM `kuis` WHERE nama_kuis LIKE '%$search_result%'";

$result_search = mysqli_query($host, $sql_search);
$count_search = mysqli_num_rows($result_search);

$sql_search_user = "SELECT * FROM `pengguna` WHERE username LIKE '%$search_result%'";

$result_search_user = mysqli_query($host, $sql_search_user);
$count_search_user = mysqli_num_rows($result_search_user);
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

        .container{
            margin-top: 64px;
            display: grid;
            grid-template-columns: auto auto auto;
            gap: 64px;
        }

        .card-course{
            width: 594px;
            height: 464px;
            border: 3px solid #AD7BE9;
            border-radius: 36px;
            
            
        }

        .card-title{
            height: 76px;
            font-size: 36px;
            text-align: center;
            font-weight: 400;
            padding-top: 24px;
            background-color: #AD7BE9;
            color: #FFFFFF;
            border-radius: 32px 32px 0 0;
        }

        .cover{
            height: 254px;
        }

        .play-menu{
            border-top:3px solid #AD7BE9 ;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .score-avg{
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .question-num{
            font-size: 24px;
            font-weight: 400;
            color: #AD7BE9;
            margin-left: 32px;
            margin-top: 16px;
        }

        .avg{
            font-size: 24px;
            font-weight: 400;
            color: #AD7BE9;
            text-decoration: none;
            margin-right: 32px;
            margin-top: 16px;
        }

        
        .avg:hover{
            cursor: pointer;
            color: #3E54AC;
        }

        .play-button{
            width: 530px;
            height: 50px;
            border-radius: 28px;
            background-color: #694E8A;
            color: #FFFFFF;
            font-size: 24px;
            font-family: 'Share Tech Mono', monospace;
        }

        .play-button:hover{
            cursor: pointer;
        }
</style>
<body>
<h1>Search Result</h1>
<h1>QUIZ</h1>
<p>Total Result : <?php echo $count_search; ?></p>
<?php if ($count_search >= 1) { ?>
    <div class="container" >
    <?php while ($row_search_result = mysqli_fetch_array($result_search)) {
        $id_kuis = $row_search_result['id_kuis'];
        $select_question = "SELECT * FROM soal WHERE id_kuis = $id_kuis";
    
        $res_sel = mysqli_query($host, $select_question);
        $count_ques = mysqli_num_rows($res_sel);
        $get_id_kategori = $row_search_result['id_kategori'];
        $select_category = "SELECT kategori.nama_kategori, kuis.id_kategori FROM kategori INNER JOIN kuis ON kategori.id_kategori = $get_id_kategori;";
        $result_category = mysqli_query($host, $select_category);
        $row_category = mysqli_fetch_array($result_category);?>
        <div class="card-course">
        <h1 class="card-title"><?php echo $row_search_result['nama_kuis'];?></h1>
        <div class="cover"></div>
        <div class="play-menu">
            <div class="score-avg">
                <h1 class="question-num"><?php echo $count_ques. " QUESTIONS"; ?></h1>
                <a href="" class="avg"><?php echo "CATEGORY: ".$row_category['nama_kategori']; ?></a>
            </div>
            <button class="play-button" ><a href="playmenu.php?play=<?php echo $id_kuis; ?>">GO PLAY!</a></button>
        </div>
    </div>
    <?php } ?>
    
    
</div>
<?php } else{ ?>
    <h1>NO RESULT FOUND FOR '<?php echo $search_result; ?>' MA FREND</h1>
<?php } ?>
<h1>User</h1>
<?php if($count_search_user >= 1){
    while($row_search_user = mysqli_fetch_array($result_search_user)){ ?>
    <h2><?php echo $row_search_user['username'];?></h2>
    <?php }}else{ ?>
        <h1>NO USER FOUND FOR '<?php echo $search_result; ?>' MA FREND</h1>
    <?php } ?>

    


</body>