<?php
session_start();

include("db.php");
$username_error_massage = "";
$password_error_massage = "";
$email_error_massage = "";
$confirm_password_error_massage = "";

if(isset($_POST['insert'])){

    $username = $_POST['username'];
    $password_register = md5($_POST['password-register']);
    $email_register = $_POST['email-register'];
    $con_pass = $_POST['confirm-password'];

    $have_numbers = false;

    if(empty(trim($username))){
        $username_error_massage = "Please fill this field";
    }else if(!empty(trim($username))){
        $check_user = "SELECT * FROM `pengguna` WHERE username = '$username'";

        $check_username_results = mysqli_query($host, $check_user);
        $row_check_username = mysqli_fetch_array($check_username_results, MYSQLI_ASSOC);
        $username_find = mysqli_num_rows($check_username_results);

        if($username_find == 1){
            $username_error_massage = "Username already in use";
          }
    }

    if(empty(trim($email_register))){
        $email_error_massage = "Please fill this field";

    }else if(!empty(trim($email_register))){
        $check_email = "SELECT * FROM `pengguna` WHERE email = '$email_register'";

        $check_email_results = mysqli_query($host, $check_email);
        $row_check_email = mysqli_fetch_array($check_email_results, MYSQLI_ASSOC);
        $email_find = mysqli_num_rows($check_email_results);

        if($email_find == 1){
            $email_error_massage = "Email already in use";;
          
          }
    }

    for ($i=0; $i < strlen($password_register); $i++) { 
        if(ctype_digit($password_register[$i])){
            $have_numbers = true;
            break;
        }
    }

    if(empty(trim($password_register))){
        $password_error_massage = "Please fill this field";
    } else if(!empty(trim($password_register))){
        if(strlen($password_register) >= 8){

            if($have_numbers){
    
                if ($password_register === md5($con_pass)) {
                  
                    if($username_find != 1 && $email_find != 1){
                        $sql_insert = "INSERT INTO `pengguna` (`id_user`, `email`, `password`, `username`) VALUES ('', '$email_register', '$password_register', '$username')";

                        // insert in database 
                        $rs = mysqli_query($host, $sql_insert);
                    
                        if($rs){
    
                            $check_email_after_regis = "SELECT * FROM `pengguna` WHERE email = '$email_register'";
    
                            $check_email_after_regis_results= mysqli_query($host, $check_email_after_regis);
                            $row_check_email_after_regis = mysqli_fetch_array($check_email_after_regis_results, MYSQLI_ASSOC);
                            $email_find_after_results = mysqli_num_rows($check_email_after_regis_results);
    
                            if($email_find_after_results == 1){
                                $_SESSION["username_email"] = $row_check_email_after_regis['username'];
                                $_SESSION["id_user"] = $row['id_user'];
                            }

                            if(isset($_SESSION['username_email'])){
                                header('Location: jenis-user.php');
                            }
                    }   
                 }
             
                 } else {
                    $confirm_password_error_massage = "Password and Confirm Password are different";
                 }
    
            } else{
                $password_error_massage = "Password must contain at least one number";
            }
    
        } else{
            $password_error_massage = "Password must be at least 8 characters long";
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

        .register-button{
            width: 234px;
            height: 50px;
            outline: 1.5px solid #FFFFFF;
            border: 1.5px solid #FFFFFF;
            border-radius: 28px;
            font-size: 36px;
            font-family: 'Share Tech Mono', monospace;
            color: #FFFFFF;
            background-color: #694E8A;
            transition: ease-out 0.3s;
        }

        .register-button:hover{
            outline-offset: 6px;
            cursor: pointer;
        }

        .login-button{
            width: 234px;
            height: 50px;
            outline: 1.5px solid #694E8A;
            border: 1.5px solid #694E8A;
            border-radius: 28px;
            margin-right: 32px;
            background-color: #FFFFFF;
            transition: ease-out 0.3s;
        }

        .login-button a{
            font-size: 36px;
            font-family: 'Share Tech Mono', monospace;
            color: #694E8A;
            text-decoration: none;
        }

        .login-button:hover{
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
            <button class="login-button" ><a href="login.php" >LOG IN</a></button>
            <button class="register-button" >REGISTER</button>
        </nav>
        </div>
        
        <div class="content">
            <section class="sec" id="home">
                <h1 id="title" >REGISTER</h1>

                <div class="container" >

                    <form action="" method="post" id="register" class="fade-in" >
                        <div class="cont_user">
                            <div class="uname">
                                <label for="username" class="username" >USERNAME</label>
                                <p class="error-small" ><?php echo $username_error_massage; ?></p>
                                <input type="text" name="username" id="username">
                            </div>
                            <div class="email-con" >
                                <label for="email" class="email" >EMAIL</label>
                                <p class="error-small" ><?php echo $email_error_massage; ?></p>
                                <input type="text" name="email-register" id="email-regis">
                            </div>
                        
                        
                        </div>
                        
                        <label for="password" class="user-password" >PASSWORD</label>
                        <p for="error" class="error"><?php echo $password_error_massage; ?></p>
                        <div class="password">
                            <input type="password" name="password-register" id="password-regis">
                            <img src="ASSET_UKL/icon/blue-icon/eye-off.png" id="eye-regis" onclick="showpassRegis()" >
                        </div>

                        <label for="con-password" class="user-password" >CONFIRM PASSWORD</label>
                        <p for="error" class="error"><?php echo $confirm_password_error_massage; ?></p>

                        <div class="password">
                            <input type="password" name="confirm-password" id="password-confirm">
                            <img src="ASSET_UKL/icon/blue-icon/eye-off.png" id="eye-con" onclick="showpassCon()" >
                        </div>
                        <button type="submit" name="insert">REGISTER</button>
                        
                        <div class="link">
                            <label for="" class="label-link" >Already have an account ?</label>
                            <label class="link-login" id="link-login" onclick="openLogin()" >LOG IN</label>
                        </div>
                        

                    </form>
                </div>
                
            </section>
        </div>
    
    </div>
    

    <script>

        function showpassRegis() {
            var x = document.getElementById("password-regis");
            var y = document.getElementById("eye-regis");
            if (x.type === "password") {
              x.type = "text";
              y.src = 'ASSET_UKL/icon/blue-icon/eye.png';
            
            } else {
              x.type = "password";
              y.src = 'ASSET_UKL/icon/blue-icon/eye-off.png';
            
            }
        }

        function showpassCon() {
            var x = document.getElementById("password-confirm");
            var y = document.getElementById("eye-con");
            if (x.type === "password") {
              x.type = "text";
              y.src = 'ASSET_UKL/icon/blue-icon/eye.png';
            
            } else {
              x.type = "password";
              y.src = 'ASSET_UKL/icon/blue-icon/eye-off.png';
            
            }
        }

        var registerForm =document.getElementById('register');
        var title = document.getElementById('title');

        function openLogin() {

            window.location.href = 'login.php';
            registerForm.classList.remove('fade-in');
            registerForm.classList.add('fade-out');

        }

        function backHome() {
            window.location.href = 'index.php';
        }


    </script>
    
</body>
</html>