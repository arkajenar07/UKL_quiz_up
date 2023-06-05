<?php
session_start();
include("db.php");

$id_pembuat = $_SESSION["id_user"];

$sql = "SELECT * FROM `kuis`";
$select_your_quiz = "SELECT * FROM kuis WHERE id_pembuat = '$id_pembuat'";

$result = mysqli_query($host, $sql);
$result_your_quiz = mysqli_query($host, $select_your_quiz);
$count_your_quiz = mysqli_num_rows($result_your_quiz);


if(isset($_POST['submit'])){
    $search = $_POST['search'];
    
    $_SESSION['searchData'] = $search;
    header('Location: search.php');
    if(isset( $_SESSION['searchData'])){
        header('Location: search.php');
    }
    
}

if(isset($_POST['edit'])){
    
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
            justify-content: space-between;
            align-items: center;

        }
        .menu{
            display: flex;
            margin-right: 32px;
        }
        .page{
            margin-left: 300px;

        }

        #home{
            height: 832px;
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
            width: 396px;
            height: 64px;
            background-color: #694E8A;
            outline: 3px solid #694E8A;
            border: none;
            border-radius: 35px;
            font-family: 'Share Tech Mono', monospace;
            font-size: 48px;
            color: #FFFFFF;
            transition: ease-out 0.3s;

            animation-name: intro;
            animation-duration: 0.5s;
            animation-timing-function: ease-in-out;
        }

        #home button:hover{
            outline-offset: 6px;
        }

        .content-title{
            font-size: 128px;
            color: #3E54AC;
            text-align: center;
        }

        #home p{
            margin-top: 54px;
            font-family: 'Share Tech Mono', monospace;
            font-size: 38px;
            color: #694E8A;
            text-align: center;
        }

        .center_cont{
            display: flex;
            justify-content: center;
        }
        .course_title{
            margin-left: 64px;
            font-size: 42px;
            color: #694E8A;
            font-weight: 400;
        }

        #feedback h1{
            font-size: 84px;
            color: #3E54AC;
            text-align: center;
        }

        .container{
            margin-top: 64px;
            display: grid;
            grid-template-columns: auto auto;
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
        }

        .play-button a{
            color: #FFFFFF;
            font-size: 24px;
            font-family: 'Share Tech Mono', monospace;
            text-decoration: none;
        }

        .play-button:hover{
            cursor: pointer;
        }
        
        .search-bar{
            width: 880px;
            height: 72px;
            border-radius: 36px;
            display: flex;
            align-items: center;
            outline: 3px solid #FFFFFF;
            outline-offset: 4px;
            margin-left: 36px;
        }

        .search-bar button:hover{
            cursor: pointer;
        }

        #search{
            width: 100%;
            height: 100%;
            margin-left: 32px;
            outline: none;
            border: none;
            color: #AD7BE9;
            font-size: 24px;
            font-family: 'Share Tech Mono', monospace;
            
        }

        .settings{
            width: 180px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #FFFFFF;
            border: 1px solid #694E8A;
            border-radius: 28px;
            outline: 1px solid #694E8A;
            transition: 0.2s;
        }

        .settings:hover{
            cursor: pointer;
            outline-offset: 3px;
            outline: 1px solid #FFFFFF;
        }

        .create-quiz{
            margin-right: 32px;
            width: 240px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #FFFFFF;
            border: 1px solid #694E8A;
            border-radius: 28px;
            outline: 1px solid #694E8A;
            transition: 0.2s;
        }

        .create-quiz:hover{
            cursor: pointer;
            outline-offset: 3px;
            outline: 1px solid #FFFFFF;
        }

        .settings a, .create-quiz a{
            color: #694E8A;
            font-size: 24px;
            font-family: 'Share Tech Mono', monospace;
            margin-right: 12px;
            text-decoration: none;

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
                <a href="#course">
                    <img src="ASSET_UKL/icon/white-icon/COURSE.png"  class="icon-normal">
                    <img src="ASSET_UKL/icon/purple-icon/COURSE.png"  class="icon-active">
                    <span class="title">MY COURSE</span>
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
            <form class="search-bar" style="background-color: #FFFFFF;" method="POST" >
                <input type="text" name="search" id="search" placeholder="Search course..." autocomplete="off" >
                <button style="background: none; border: none; width: 32px; margin-right: 32px;" name="submit"><img src="ASSET_UKL/icon/purple-icon/search.png" alt="" width="34px"></button>
            </form>
            <div class="menu">
           <!-- <button class="notification" >NOTIFICATION</button>-->
           <button class="create-quiz" ><a href="create-quiz.php" >CREATE QUIZ +</a></button>
            <button class="settings" ><a href="account-details.php" >ACCOUNT</a> <img src="ASSET_UKL/icon/purple-icon/ACCOUNT-DARK.png" width="32px" ></button>
            <img src="" alt="">
            </div>
            
        </nav>
        <div class="content">
            <section class="sec" id="home">
            <h1>WELCOME, <?php echo $_SESSION['username_email']; ?></h1>
                <pre>With new quizzes added regularly and exciting rewards up for 
grabs, there's never been a better time to start playing. 
Welcome to Quiz Up buddy and let the games begin!</pre>
                <button>GO TO COURSE</button>
                    
                    
                </div>
            </section>
            <section class="sec" id="course">
                <h1 class="course_title" >My Course</h1>
                <div class="center_cont">
                
                <div class="container" >
                    <?php if ($count_your_quiz >= 1) { ?>
                    <div class="container" >
                    <?php while ($row_your_quiz = mysqli_fetch_array($result_your_quiz)) {
                        $id_kuis = $row_your_quiz['id_kuis'];
                        $select_question = "SELECT * FROM soal WHERE id_kuis = $id_kuis";
                    
                        $res_sel = mysqli_query($host, $select_question);
                        $count_ques = mysqli_num_rows($res_sel);
                        $id = $row_your_quiz['id_kuis'];
                        $get_id_kategori = $row_your_quiz['id_kategori'];
                        $select_category = "SELECT kategori.nama_kategori, kuis.id_kategori FROM kategori INNER JOIN kuis ON kategori.id_kategori = $get_id_kategori;";
                        $result_category = mysqli_query($host, $select_category);
                        $row_category = mysqli_fetch_array($result_category);?>
                        <div class="card-course">
                        <h1 class="card-title"><?php echo $row_your_quiz['nama_kuis'];?></h1>
                        <div class="cover"></div>
                        <div class="play-menu">
                            <div class="score-avg">
                                <h1 class="question-num"><?php echo $count_ques." QUESTIONS"; ?></h1>
                                <a href="#" class="avg"><?php echo "CATEGORY: ".$row_category['nama_kategori']; ?></a>
                            </div>
                            <button class="play-button" type="submit" name="edit" ><a href="set-quiz.php?set=<?php echo $row_your_quiz['id_kuis']; ?>" >EDIT YOUR QUIZ</a></button>
                        </div>
                    </div>
                    <?php } ?>
                    
                    
                    </div>
                    <?php } else{ ?>
                        <h1>NO QUIZ FOUND MA FREND, MAKE ONE </h1>
                    <?php } ?>
                </div>
                </div>
            </section>
            <section class="sec" id="feedback">
                <h1>FEEDBACK AND RATINGS</h1>
        
            </section>
            <section class="sec" style="background-color: orange;" id="about-us"></section>
        </div>
    
    </div>
    <?php
    ?>
    

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