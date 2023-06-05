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
            height: 832px;
            padding-top: 243px;
        }

        .sidebar {
            position: fixed;
            width: 300px;
            height: 1080px;
            top: 0;
            left: 0;
            z-index: 10;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #AD7BE9;


            /*animasi*/
            animation-name: slide;
            animation-duration: 0.2s;
            animation-timing-function: ease-in;
        }


        .sidebar ul{
            list-style: none;
            display: flex;
            flex-direction: column;
        }

        .sidebar ul li{
            margin-bottom: 32px;
        }

        .sidebar ul li a{
            width: 273px;
            height: 76px;
            border-radius: 38px;
            color: #FFFFFF;
            background-color: none;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar ul li a:hover{
            outline: 3px solid #FFFFFF;
        }

        .sidebar ul .active a {
            color: #AD7BE9;
            background-color: #FFFFFF;
        }

        .sidebar ul li a .icon-normal{
            display: block;
            width: 40px;
            margin-left: 32px;
        }

        .sidebar ul li a .icon-active{
            display: none;
            width: 40px;
            margin-left: 32px;
        }

        .sidebar ul .active a .icon-normal{
            display: none;
            width: 40px;
            margin-left: 32px;
        }

        .sidebar ul .active a .icon-active{
            display: block;
            width: 40px;
            margin-left: 32px;
        }

        .title{
            font-size: 26px;
            margin-left: 16px;
        }

        .navbar{
            position: fixed;
            margin: 64px;
            width: 80%;
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
            background-color: #694E8A;
            margin-right: 32px;
            transition: ease-out 0.3s;
        }

        .login-button a{
            font-size: 36px;
            font-family: 'Share Tech Mono', monospace;
            color: #FFFFFF;
            text-decoration: none;
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
            margin-left: 300px;

        }

        #home{
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #home h1{
            margin-top: 128px;
            font-size: 128px;
            color: #3E54AC;
            text-align: center;

            /*animasi*/ 
            animation-name: intro;
            animation-duration: 0.5s;
            animation-timing-function: ease-in-out;
        }

        #home pre{
            margin-top: 64px;
            font-family: 'Share Tech Mono', monospace;
            font-size: 32px;
            color: #694E8A;
            text-align: center;

            animation-name: intro;
            animation-duration: 0.5s;
            animation-timing-function: ease-in-out;
        }

        #home button{
            margin-top: 64px;
            width: 418px;
            height: 111px;
            background-color: #694E8A;
            outline: 3px solid #694E8A;
            border: none;
            border-radius: 36px;
            font-family: 'Share Tech Mono', monospace;
            font-size: 54px;
            color: #FFFFFF;
            transition: ease-out 0.3s;

            animation-name: intro;
            animation-duration: 0.5s;
            animation-timing-function: ease-in-out;
        }

        #home button:hover{
            outline-offset: 6px;
        }

        #feedback h1{
            font-size: 84px;
            color: #3E54AC;
            text-align: center;
        }

        @keyframes intro{
            0%{
                opacity: 0;
                transform: translateY(-30px) scale(0.9);
            }

            100%{
                opacity: 1;
                transform: translateY(0px) scale(1);
            }
        }

        @keyframes slide{
            0%{
                opacity: 0;
                transform: translateX(-20px) scale(1);
            }

            100%{
                opacity: 1;
                transform: translateX(0px) scale(1);
            }
        }


        
</style>


<body>

    <div class="sidebar">
        <ul>
            <li class="list active">
                <a href="#home">
                    <img src="ASSET_UKL/icon/white-icon/HOME.png"  class="icon-normal">
                    <img src="ASSET_UKL/icon/purple-icon/HOME.png"  class="icon-active">
                    <span class="title">HOME</span>
                </a>
            </li>
            <li class="list">
                <a href="#feedback">
                    <img src="ASSET_UKL/icon/white-icon/FEEDBACK.png"  class="icon-normal">
                    <img src="ASSET_UKL/icon/purple-icon/FEEDBACK.png"  class="icon-active">
                    <span class="title">FEEDBACK</span>
                </a>
            </li>
            <li class="list">
                <a href="#about-us">
                    <img src="ASSET_UKL/icon/white-icon/ABOUT-US.png"  class="icon-normal">
                    <img src="ASSET_UKL/icon/purple-icon/ABOUT-US.png"  class="icon-active">
                    <span class="title">ABOUT US</span>
                </a>
            </li>

        </ul>
    </div>

    <div class="page">
        <nav class="navbar">
            <button class="login-button" ><a href="login.php" >LOG IN</a></button>
            <button class="register-button" ><a href="register.php" >REGISTER</a></button>
        </nav>
        <div class="content">
            <section class="sec" id="home">
                <h1>QUIZ UP!</h1>
                <pre>Welcome to Quiz Up! The ultimate course quiz game 
for students of all ages! Challenge yourself and 
test your knowledge!</pre>
                <button>GET STARTED</button>
            </section>
            <section class="sec" id="feedback">
                <h1>FEEDBACK AND RATINGS</h1>
        
            </section>
            <section class="sec" style="background-color: orange;" id="about-us"></section>
        </div>
    
    </div>
    

    <script>
        let section = document.querySelectorAll('section');
        let lists = document.querySelectorAll('.list');
        function activeLink(li) {
            lists.forEach((item) => item.classList.remove('active'));
            li.classList.add('active');
        }
        lists.forEach((item) =>
            item.addEventListener('click', function(){
                activeLink(this);
            }));

        window.onscroll = () => {
            section.forEach(sec => {
                let top = window.scrollY + 248;
                let offset = sec.offsetTop;
                let height = sec.offsetHeight;
                let id = sec.getAttribute('id');

                if (top >= offset && top < offset + height) {
                    const target = document.querySelector(`[href='#${id}']`).parentElement;
                    activeLink(target);
                }
            })
        };
    </script>
    
</body>
</html>