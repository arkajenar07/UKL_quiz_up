<?php
session_start();
include('db.php');

$id_user = $_SESSION["id_user"];
echo $id_user;
$username_email = $_SESSION["username_email"];


if(isset($_POST['submit-student'])){
    $sql_update = "UPDATE `pengguna` SET `jenis_user`='murid' WHERE id_user = $id_user";
    $result = mysqli_query($host, $sql_update);
    if($result){
        header('location: page.php');
    } else{
        echo "ERROR";
    }
}

if(isset($_POST['submit-mentor'])){
    $sql_update_mentor = "UPDATE `pengguna` SET `jenis_user`='mentor' WHERE id_user = $id_user";
    $result_mentor = mysqli_query($host, $sql_update_mentor);
    if($result_mentor){
        header('location: page-mentor.php');
    } else{
        echo "ERROR";
    }
}

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

    h1{
        font-size: 96px;
        color: #3E54AC;
        text-align: center;
        margin-top: 256px;
    }

    .title{
        font-size: 42px;
        color: #FFFFFF;
        text-align: center;
        margin-top: 32px;
        font-family: 'Share Tech Mono', monospace;
    }

    .container{
        display: flex;
        justify-content: center;
        align-items: center;
        
        
    }

    .box-student, .box-mentor{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 400px;
        height: 400px;
        border: none;
        border-radius: 36px;
        background-color: #AD7BE9;
        box-shadow: 10px 10px 30px grey;
        margin: 64px;
        transition: 0.5s;
    }

    .box-student:hover, .box-mentor:hover{
        width: 420px;
        height: 420px;
    }

</style>
<body>
    <form action="" method="post">
    <h1>WHAT YOU WANT TO BE ? <?php echo $username_email; ?></h1>
    <div class="container">
    <button class="box-student" name="submit-student" type="submit">
        <h1 class="title" >STUDENT</h1>
        <img src="ASSET_UKL/image/students.png" alt="" width="256px">
    </button>
    <h1 class="title" >OR</h1>
    <button class="box-mentor" name="submit-mentor" type="submit">
        <h1 class="title" >MENTOR</h1>
        <img src="ASSET_UKL/image/teacher.png" alt="" width="256px">
        
    </form>
    </button>
    
</body>
</html>