<?php
session_start();
$_SESSION["username_email"] = "";
$_SESSION["jenis_user"] = "";
$_SESSION["id_user"] = "";
include("db.php");
$username_error_massage = "";
$password_error_massage = "";
$email_error_massage = "";
$confirm_password_error_massage = "";

if(isset($_POST['submit'])){

    $username_email = $_POST['email']; 
    $password = md5($_POST['password']);
    if(empty(trim($username_email))){
        $email_error_massage = "Please fill this field";
    } else if(!empty(trim($username_email))){$sql_email = "SELECT * FROM `pengguna` WHERE email = '$username_email' OR username = '$username_email'";  
        
        $result_email = mysqli_query($host, $sql_email);  
        $row = mysqli_fetch_array($result_email, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result_email);

        $data = mysqli_fetch_array($result_email);

        if($count == 1){
            $email_error_massage = "";
        } else{
            $email_error_massage = "Username or Email not found, Try register! ";
        }
    }

    if(empty(trim($password))){
        $password_error_massage = "Please fill this field";

    } else if(!empty(trim($password))){
        $sql_validate = "SELECT * FROM `pengguna` WHERE (email = '$username_email' OR username = '$username_email') AND password = '$password'";  
        $result_validate = mysqli_query($host, $sql_validate);  
        $row_validate = mysqli_fetch_array($result_validate);  
        $count_val = mysqli_num_rows($result_validate);

        if(is_array($row_validate)){
            $_SESSION["username_email"] = $row['username'];
            $_SESSION["jenis_user"] = $row['jenis_user'];
            $_SESSION["id_user"] = $row['id_user'];
        } else{
            $password_error_massage = "Password incorrect, try again!";
        }

        if(isset($_SESSION['username_email'])){
            if(isset($_SESSION["jenis_user"])){
                if($_SESSION["jenis_user"] == "murid"){
                    header('Location: page.php');
                }
                if($_SESSION["jenis_user"] == "mentor"){
                    header('Location: page-mentor.php');
                }
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
        .sec {
            height: 100%;
            padding-top: 243px;
        }

        .nav{
            display: flex;
            position: fixed;
            width: 100%;
            height: 248px;
            align-items: center;
        }

        .nav img{
            height: 64px;
            margin-left: 64px;
        }

        .nav img:hover{
            cursor: pointer;
        }
       
        .navbar{
            /*position: fixed;*/
            margin: 64px;
            width: 90%;
            height: 120px;
            background-color: #AD7BE9;
            border-radius: 36px;
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .login-button{
            width: 234px;
            height: 50px;
            outline: 1.5px solid #FFFFFF;
            border: 1.5px solid #FFFFFF;
            border-radius: 28px;
            font-size: 36px;
            font-family: 'Share Tech Mono', monospace;
            color: #FFFFFF;
            background-color: #694E8A;
            margin-right: 32px;
            transition: ease-out 0.3s;
        }

        .login-button:hover{
            outline-offset: 6px;
            cursor: pointer;
        }

        .register-button{
            width: 234px;
            height: 50px;
            outline: 1.5px solid #694E8A;
            border: 1.5px solid #694E8A;
            border-radius: 28px;
            background-color: #FFFFFF;
            transition: ease-out 0.3s;
        }

        .register-button a{
            font-size: 36px;
            font-family: 'Share Tech Mono', monospace;
            color: #694E8A;
            text-decoration: none;
        }

        .register-button:hover{
            outline-offset: 6px;
            cursor: pointer;
        }

        .page{
            margin-left: 0px;

        }

        #home{
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #home h1{
            font-size: 72px;
            color: #694E8A;
            text-align: center;
        }

        #home pre{
            margin-top: 64px;
            font-family: 'Share Tech Mono', monospace;
            font-size: 32px;
            color: #694E8A;
            text-align: center;
        }

        #home button{
            margin-top: 32px;
            margin-left: 374px;
            width: 257px;
            height: 75px;
            background-color: #FFFFFF;
            outline: 3px solid #694E8A;
            border: 3px solid #694E8A;
            border-radius: 36px;
            font-family: 'Share Tech Mono', monospace;
            font-size: 48px;
            color: #694E8A;
            transition: ease-out 0.3s;
        }

        #home button:hover{
            outline-offset: 6px;
        }

        #feedback h1{
            font-size: 84px;
            color: #3E54AC;
            text-align: center;
        }

        .container{
            display: flex;
            justify-content: center;
        }

        #login{
            width: 994px;
            height: 646px;
            display: flex;
            flex-direction: column;
            margin-top: 64px;
            margin-bottom: 64px;
            border: 3px solid #AD7BE9;
            border-radius: 36px;
            background-color: #FFFFFF;
            position: absolute;
            z-index: 2;
        }

        #login a{
            margin-left: 64px;
            margin-top: 16px;
            font-size: 20px;
            color: #3E54AC;
            text-decoration: none;
        }
        
        .user-email{
            margin-top: 64px;
            margin-left: 64px;
            font-size: 26px;
            color: #AD7BE9;
        }

        .user-password{
            margin-top: 32px;
            margin-left: 64px;
            font-size: 26px;
            color: #AD7BE9;
        }

        .username{
            margin-top: 64px;
            margin-left: 64px;
            font-size: 26px;
            color: #AD7BE9;
        }

        .email{
            margin-top: 64px;
            margin-left: 64px;
            font-size: 26px;
            color: #AD7BE9;
        }

        #email{
            margin-top: 2px;
            width: 834px;
            height: 64px;
            margin-left: 64px;
            padding-left: 32px;
            border: none;
            outline: 3px solid #AD7BE9;
            border-radius: 18px;
            font-family: 'Share Tech Mono', monospace;
            font-size: 24px;
            color: #AD7BE9;
        }

        #email:focus{
            outline: 3px solid #3E54AC; 
        }

        #username{
            margin-top: 2px;
            width: 369px;
            height: 64px;
            margin-left: 64px;
            padding-left: 32px;
            border: none;
            outline: 3px solid #AD7BE9;
            border-radius: 18px;
            font-family: 'Share Tech Mono', monospace;
            font-size: 24px;
            color: #AD7BE9;
        }

        #username:focus{
            outline: 3px solid #3E54AC; 
        }

        #email-regis{
            margin-top: 2px;
            width: 369px;
            height: 64px;
            margin-left: 64px;
            padding-left: 32px;
            border: none;
            outline: 3px solid #AD7BE9;
            border-radius: 18px;
            font-family: 'Share Tech Mono', monospace;
            font-size: 24px;
            color: #AD7BE9;
        }

        #email-regis:focus{
            outline: 3px solid #3E54AC; 
        }

        .password{
            margin-top: 2px;
            width: 834px;
            height: 64px;
            margin-left: 64px;
            padding-left: 32px;
            border: none;
            outline: 3px solid #AD7BE9;
            border-radius: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #password, #password-regis, #password-confirm{
            width: 738px;
            height: 64px;
            outline: none;
            border: none;
            font-family: 'Share Tech Mono', monospace;
            font-size: 24px;
            color: #AD7BE9;
        }

        #eye, #eye-regis, #eye-con{
            width: 32px;
            margin-right: 32px;
        }

        .error{
            font-size: 20px;
            color: #CC0000;
            text-align: right;
            padding-right: 64px;
        }

        .error-small{
            font-size: 20px;
            color: #CC0000;
            text-align: right;
            
        }

        #register{
            width: 994px;
            height: 646px;
            display: flex;
            flex-direction: column;
            margin-top: 64px;
            margin-bottom: 64px;
            border: 3px solid #AD7BE9;
            border-radius: 36px;
            background-color: #FFFFFF;
            position: absolute;
        }

        .cont_user{
            display: flex;
            margin-top: 64px;
        }
        
        .link{
            display: flex;
            justify-content: center;
            margin-top: 16px;
        }

        .label-link{
            margin-right: 16px;
            color: #AD7BE9;
        }

        .link-login{
            color: #3E54AC;
            
        }

        .link-login:hover{
            cursor: pointer;
        }
        .fade-out{
            animation-name: outro;
            animation-duration: 0.5s;
            animation-timing-function: ease-in-out;
            animation-fill-mode: forwards;
        }

        .fade-in{
            animation-name: intro;
            animation-duration: 0.5s;
            animation-timing-function: ease-in-out;
            animation-fill-mode: forwards;
        }

        @keyframes intro{
            0%{
                opacity: 0;
                transform: translateY(-60px) scale(0.9);
            }

            100%{
                opacity: 1;
                transform: translateY(0px) scale(1);
            }
        }

        @keyframes outro{
            0%{
                opacity: 1;
                transform: translateY(0px) scale(1);
            }

            100%{
                opacity: 0;
                transform: translateY(60px) scale(0.9);
            }
        }

        @keyframes fadeIn{
            0%{
                visibility: hidden;
                z-index: 0;
            }

            50%{
                transform: translateX(-90%);
            }
            100%{
                visibility: visible;
                z-index: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeOut{
            0%{
                visibility: visible;
                z-index: 1;
            }

            50%{
                transform: translateX(90%);
            }
            100%{
                visibility: hidden;
                z-index: 0;
                transform: translateX(0);
            }
        }
</style>


<body>

    <div class="page">
        <div class="nav">
        <img src="ASSET_UKL/icon/purple-icon/BACK-ARROW.png" onclick="backHome()">
        <nav class="navbar">
            <button class="login-button" >LOG IN</button>
            <button class="register-button" ><a href="register.php" >REGISTER</a></button>
        </nav>
        </div>
        
        <div class="content">
            <section class="sec" id="home">
                <h1 id="title" >LOG IN</h1>

                <div class="container" >
                    <form action="" method="post" id="login" class="fade-in" >
                        <label for="email-username" class="user-email" >USERNAME or EMAIL</label>
                        <p class="error" ><?php echo $email_error_massage; ?></p>
                        <input type="text" name="email" id="email">
                        <label for="password" class="user-password" >PASSWORD</label>
                        <p for="error" class="error"><?php echo $password_error_massage; ?></p>
                        <div class="password">
                            <input type="password" name="password" id="password">
                            <img src="ASSET_UKL/icon/blue-icon/eye-off.png" id="eye" onclick="showpass()" >
                        </div>
                        <a href="forgot.php">FORGOT PASSWORD ?</a>
                        <button type="submit" name="submit">LOG IN</button>

                        <div class="link">
                            <label for="" class="label-link" >Don't have an account ?</label>
                            <label for="link-login" class="link-login" id="link-login" onclick="openRegister()">REGISTER</label>
                        </div>


                    </form>


                </div>
                
            </section>
        </div>
    
    </div>
    

    <script>
        function showpass() {
            var x = document.getElementById("password");
            var y = document.getElementById("eye");
            if (x.type === "password") {
              x.type = "text";
              y.src = 'ASSET_UKL/icon/blue-icon/eye.png';
            
            } else {
              x.type = "password";
              y.src = 'ASSET_UKL/icon/blue-icon/eye-off.png';
            
            }
        }

        var loginForm =document.getElementById('login');
        var title = document.getElementById('title');

        function openRegister() {

            window.location.href = 'register.php';
            loginForm.classList.remove('fade-in');

            loginForm.classList.add('fade-out');
            
        }

        function backHome() {
            window.location.href = 'index.php';
        }
    </script>
    
</body>
</html>