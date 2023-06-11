<?php
session_start();

include('db.php');
$id_user = $_SESSION["id_user"];

$sql = "SELECT * FROM `pengguna` WHERE id_user = $id_user";
$result = mysqli_query($host, $sql);
$row = mysqli_fetch_array($result);
if(isset($_POST['logout'])){
    session_destroy();
    header("Location: index.php");
}

$profile_error_massage = "";

if(isset($_POST['save'])){
    $username = $_POST['uname'];
    $filename = $_FILES["profile"]["name"];
    $tempname = $_FILES["profile"]["tmp_name"];
    $folder = "./ASSET_UKL/image/" . $filename;
    

    if($filename == ""){
        $update = "UPDATE `pengguna` SET `username`='$username' WHERE id_user = $id_user ";
        $query = mysqli_query($host, $update);
        if($query){
            echo "<script> 
                alert('CHANGE SAVED !');
                window.location.href = 'account-details.php';
            </script>";
            
        }

    } else if($filename != ""){
        
        
        $update_img = "UPDATE `pengguna` SET `username`='$username', `foto_profil`='$filename' WHERE id_user = $id_user ";
        $query_pp = mysqli_query($host, $update_img);
        if($query_pp){
            if (move_uploaded_file($tempname, $folder)) {
                echo "<script> 
                    alert('CHANGE SAVED !');
                    window.location.href = 'account-details.php';
                </script>";
            }
        }
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
    .details{
        margin-left: 50%;
        transform: translateX(-50%);
        border: 4px solid #AD7BE9;
        margin-top: 64px;
        width: 840px;
        background-color: #AD7BE9;
    }
    .title{
        margin-top: 16px;
        padding-bottom: 64px;
        text-align: center;
        color: #FFFFFF;
    }
    .container{
        background-color: #FFFFFF;
        padding: 32px;
    }

    .profile{
        width: 96px;
        height: 96px;
        margin-left: 50%;
        margin-top: -86px;
        transform: translateX(-50%);
        border-radius: 96px;
        border: 3px solid #AD7BE9;
    }

    .info{
        margin-top: 16px;
        margin-bottom: 32px;
        padding: 0;
        text-align: left;
        color: #694E8A;
        padding-left: 8px;
    }

    #username{
        font-family: 'Share Tech Mono', monospace;
        width: 100%;
        height: 48px;
        font-size: 24px;
        padding-left: 8px;
        border: none;
        color: #AD7BE9;
        outline: none;
    }

    #username:disabled{
        background-color: #FFFFFF;
        color: #694E8A;
    }

    h3{
        width: 100%;
        padding: 12px 0 12px 0;
        font-family: 'Share Tech Mono', monospace;
        font-size: 24px;
        font-weight: 400;
        padding-left: 8px;
        color:#694E8A;
        border-top: 2px solid #694E8A;
        border-bottom: 2px solid #694E8A;
        
    }

    .input-con{
        height: max-content;
        font-family: 'Share Tech Mono', monospace;
        font-size: 24px;
        font-weight: 400;
        border-top: 2px solid #694E8A;
        border-bottom: 2px solid #694E8A;
        display: flex;
        align-items: center;
    }

    .icon{
        width: 32px;
        height: 32px;
    }

    .back{
        background: none;
        border: none;
        margin: 16px 0 0 16px;
    }

    .back:hover{
        cursor: pointer;
    }

    .submit{
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 36px;
    }

    .acc-btn{
        width: 530px;
        height: 50px;
        border-radius: 28px;
        background-color: #FFFFFF;
        color: #694E8A;
        border: 2px solid #694E8A;
        border-radius: 24px;
        margin-bottom: 36px;
        font-size: 24px;
        font-family: 'Share Tech Mono', monospace;
        text-decoration: none;
    }

    .acc-btn:hover{
        cursor: pointer;
    }

    .sv-btn{
        width: 530px;
        height: 50px;
        border-radius: 28px;
        background-color: #694E8A;
        color: #FFFFFF;
        border-radius: 24px;
        font-size: 24px;
        font-family: 'Share Tech Mono', monospace;
        text-decoration: none;
    }

    .sv-btn:hover{
        cursor: pointer;
    }
    
    
</style>
<body>
    
        
    <img src="ASSET_UKL/icon/purple-icon/BACK-ARROW.png" onclick="backHome()">
    
    
    <form action="" method="post" enctype="multipart/form-data" class="details" >
    <h1 class="title">ACCOUNT DETAILS</h1>
    <div class="container" >
    <img class="profile" src="./ASSET_UKL/image/<?php echo $row['foto_profil']; ?>" alt="">
    
    <h1 class="info">USERNAME</h1>
    <div class="input-con" ><input type="text" name="uname" maxlength="15" id="username" value="<?php echo $row['username'] ?>" disabled ><img class="icon" src="ASSET_UKL/icon/purple-icon/EDIT.png" alt="" id="edit"> </div>
    <h1 class="info">JENIS USER</h1>
    <h3 id="jenis" ><?php echo strtoupper($row['jenis_user']); ?></h3>
    <h1 class="info">UPDATE PROFILE PICTURES</h1>
    <input type="file" name="profile" id="profile-pic">
    <div class="submit">

    <button type="submit" name="logout" class="acc-btn">LOG OUT</button>
    <button type="submit" id="save" name="save" class="sv-btn" >SAVE CHANGES</button>
    </div>
    
    </div>
    </form>

    <script>
        let username = document.getElementById('username');
        let save = document.getElementById('save');
        let edit = document.getElementById('edit');
        let jenis = document.getElementById('jenis');

        edit.addEventListener('click', () => {
            username.disabled = false;  
            save.style.display = "block";
        });

        save.addEventListener('click', () => {
            username.disabled = false;  
        });
        

        function backHome() {
            if(jenis.innerHTML == "MENTOR"){
                window.location.href = 'page-mentor.php';
            }
            if(jenis.innerHTML == "MURID"){
                window.location.href = 'page.php';
            }
            
        }
    </script>
</body>
</html>