<?php
session_start();
include("db.php");
$id_user = $_SESSION["id_user"];

$select_user = "SELECT * FROM `pengguna` WHERE id_user = $id_user";
$result_user = mysqli_query($host, $select_user);
$data_user = mysqli_fetch_array($result_user);

$sql = "SELECT * FROM `kuis`";

$result = mysqli_query($host, $sql);

if(isset($_POST['submit'])){
    $search = $_POST['search'];
    
    $_SESSION['searchData'] = $search;
    header('Location: search.php');
    if(isset( $_SESSION['searchData'])){
        header('Location: search.php');
    }
    
}

if(isset($_POST['feed'])){
    $pesan = $_POST['pesan'];
    $rate = $_POST['rate'];

    $feed = "INSERT INTO `feedback`(`id_feedback`, `pesan_feedback`, `rating`, `tanggal_kirim`, `id_pengirim`) VALUES ('','$pesan','$rate', now(), '$id_user')";
    $query_feed = mysqli_query($host, $feed);

    if($query_feed){
        header('Location: page.php');
    }


}

$show_feed = "SELECT * FROM `feedback`";
$query_show_feed = mysqli_query($host, $show_feed);
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

        #feedback h1, #about-us h1{
            font-size: 84px;
            color: #3E54AC;
            text-align: center;
        }

        .subtitle{
            font-size: 42px;
            color: #694E8A;
            text-align: center;
            margin-top: 37px;
            margin-bottom: 32px;
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
            display: flex;
            justify-content: center;
        }

        .cover img{
            height: 254px;
        }

        .play-menu{
            border-top:3px solid #AD7BE9 ;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .score-categ{
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .question-num{
            font-size: 24px;
            font-weight: 400;
            color: #AD7BE9;
            margin-left: 32px;
            margin-top: 8px;
        }

        .categ{
            font-size: 24px;
            font-weight: 400;
            color: #AD7BE9;
            text-decoration: none;
            margin-right: 32px;
            margin-top: 8px;
        }

        
        .categ:hover{
            cursor: pointer;
            color: #3E54AC;
        }

        .play-link{
            text-decoration: none;
        }

        .play-button{
            margin-top: 8px;
            width: 530px;
            height: 50px;
            border-radius: 28px;
            background-color: #694E8A;
            color: #FFFFFF;
            font-size: 24px;
            font-family: 'Share Tech Mono', monospace;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .play-button:hover{
            cursor: pointer;
        }

        .go{
            margin-left: 8px;
            width: 24px;
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

        .acc-details{
            text-decoration: none;
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
            color: #694E8A;
            font-size: 24px;
            font-family: 'Share Tech Mono', monospace;
            margin-right: 12px;
            transition: 0.2s;
        }

        .settings:hover{
            cursor: pointer;
            outline-offset: 3px;
            outline: 1px solid #FFFFFF;
        }

        .form-con{
            display: flex;
            justify-content: center;
        }
        .feed-form{
            display: flex;
            flex-direction: column;
            align-items: center;
            width: max-content;
        }

        .feed{
            resize: none;
            width: 1292px;
            height: 69px;
            border: 3px solid #694E8A;
            border-radius: 28px;
            outline: 3px solid #694E8A;
            outline-offset: 6px;
            text-align: center;
            font-size: 36px;
            color: #AD7BE9;
            padding-top: 24px;
            font-family: 'Share Tech Mono', monospace;

            margin: 32px 0 48px 0;
        }

        .feed::-webkit-scrollbar{
            display: none;
        }

        .len{
            align-self: flex-end;
            font-size: 16px;
            color: #694E8A;
        }
        
        #rate{
            accent-color: #AD7BE9;
            width: 320px;
        }

        .about-con{
            display: flex;
            align-items: center;
            margin-left: 64px;
        }

        .about-con .about-title{
            font-size: 48px;
            color: #694E8A;
            
        }

        .about-con  p{
            margin-top: 48px;
            font-size: 24px;
            color: #694E8A;
            width: 960px;
            text-align: justify;
        }

        .about-con img{
            width: 640px;
        }

        .noquiz{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .noquiz h1{
            font-size: 48px;
            color: #694E8A;
            margin-bottom: 32px;
        }

        .submit{
            margin-top: 48px;
            width: 240px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #694E8A;
            c
            border-radius: 28px;
            outline: 1px solid #FFFFFF;
            transition: 0.2s;   
            color: #FFFFFF;
            font-size: 24px;
            font-family: 'Share Tech Mono', monospace;
        }

        .profile-pic-feed{
            width: 120px;
            height: 120px;
            border: 2px solid #AD7BE9;
            border-radius: 96px;
            margin-top: 32px;
            margin-left: 64px;
        }

        .feedcon{
            margin-top: 64px;
            margin-left: 132px;
            display: grid;
            grid-template-columns: auto auto;
            gap: 64px;
        }

        .feedback-con{
            width: 600px;
            height: 400px;
            border: 3px solid #AD7BE9;
            border-radius: 36px;
        }

        .feedback-title{
            background-color: #AD7BE9;
            border-radius: 32px 32px 0 0;
            height: 90px;
            display: flex;
        }
        .ttl-container{
            margin-top: 48px;
            margin-left: 32px;
        }

        .username-feedback{
            font-size: 36px;
            color: #FFFFFF;
        }

        .tanggal-feedback{
            font-size: 24px;
            color: #AD7BE9;
            font-weight: 400;
        }

        .pesan-feedback{
            word-wrap: break-word;
            height: 160px;
            margin-left: 16px;
            margin-top: 72px;
            font-size: 16px;

        }

        .rate-feedback{
            height: 78px;
            border-top: 3px solid #AD7BE9;
            color: #F1E806;
            text-align: center;
            font-size: 48px;
            padding-top: 8px;
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
                    <span class="title">COURSE</span>
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
            <a href="account-details.php" class="acc-details" ><button class="settings" >ACCOUNT<img src="ASSET_UKL/icon/purple-icon/ACCOUNT-DARK.png" width="32px" ></button></a> 
            <img src="" alt="">
            </div>
            
        </nav>
        <div class="content">
            <section class="sec" id="home">
            <h1>WELCOME, <?php echo $data_user['username']; ?></h1>
                <pre>With new quizzes added regularly and exciting rewards up for 
grabs, there's never been a better time to start playing. 
Welcome to Quiz Up buddy and let the games begin!</pre>
                 <a href="#course"><button>GO TO COURSE</button></a> 
                    
                    
                </div>
            </section>
            <section class="sec" id="course">
                <h1 class="course_title" >Popular Courses</h1>
                <div class="center_cont">
                <div class="container" >
                <?php while ($row = mysqli_fetch_array($result)) {
                        $id_kuis = $row['id_kuis'];
                        $select_question = "SELECT * FROM soal WHERE id_kuis = $id_kuis";
                    
                        $res_sel = mysqli_query($host, $select_question);
                        $count_ques = mysqli_num_rows($res_sel);
                        $id = $row['id_kuis'];
                        $get_id_kategori = $row['id_kategori'];
                        $select_category = "SELECT kategori.nama_kategori, kuis.id_kategori FROM kategori INNER JOIN kuis ON kategori.id_kategori = $get_id_kategori;";
                        $result_category = mysqli_query($host, $select_category);
                        $row_category = mysqli_fetch_array($result_category);?>
                        <div class="card-course">
                        <h1 class="card-title"><?php echo $row['nama_kuis'];?></h1>
                        <div class="cover">
                            <img src="ASSET_UKL/image/questions.jpg" alt="">
                        </div>
                        <div class="play-menu">
                            <div class="score-categ">
                                <h1 class="question-num"><?php echo $count_ques." QUESTIONS"; ?></h1>
                                <a href="#" class="categ"><?php echo "CATEGORY: ".$row_category['nama_kategori']; ?></a>
                            </div>
                            <a href="playmenu.php?play=<?php echo $id_kuis; ?>" class="play-link" ><button class="play-button" >GO PLAY! <img src="ASSET_UKL/icon/white-icon/NEXT.png" class="go" ></button></a>
                        </div>
                    </div>
                    <?php } ?>
                    
                    
                </div>
                </div>
                <section class="sec" id="feedback">
                <h1>FEEDBACK AND RATINGS</h1>
                <p class="subtitle" >HOW WAS YOUR EXPERIENCE ?</p>
                <div class="form-con" >
                <form action="" method="post" class="feed-form" >
                    <p class="len" ><span id="count">0</span> / 300</p>
                    <textarea name="pesan" class="feed" id="feed" cols="100" rows="2" maxlength="300" placeholder="WRITE YOUR SUGGESTIONS OR COMMENTS HERE !" ></textarea>
                    <input type="range" name="rate" id="rate" min="1" max="10" step="0.5" value="5">
                    <p>Rate: <span id="demo">5</span> / 10</p>
                    <button type="submit" name="feed" class="submit" >SUBMIT</button>
                </form>
                </div>

                <div class="feedcon">
                    <?php while($row_feedback = mysqli_fetch_array($query_show_feed )){ ?>
                        <?php 
                            $get_id_pengirim = $row_feedback['id_pengirim'];
                            $select_pengirim = "SELECT pengguna.username, pengguna.foto_profil, feedback.id_pengirim FROM pengguna INNER JOIN feedback ON pengguna.id_user = $get_id_pengirim;";
                            $nama_get = mysqli_query($host, $select_pengirim);
                            $row_nama = mysqli_fetch_array($nama_get);
                            ?>
                        <div class="feedback-con">
                            <div class="feedback-title">
                                <img src="./ASSET_UKL/image/<?php echo $row_nama['foto_profil']; ?>" alt="" class="profile-pic-feed">
                                <div class="ttl-container">
                                    <h3 class="username-feedback" ><?php echo $row_nama['username']; ?></h3>
                                    <h3 class="tanggal-feedback"  > <?php echo $row_feedback['tanggal_kirim']; ?></h3>
                                </div>
                                
                            </div>
                            
                            <p class="pesan-feedback"><?php echo $row_feedback['pesan_feedback']; ?></p>
                            <h3 class="rate-feedback" ><?php echo $row_feedback['rating']." / 10"; ?></h3>
                        </div>
                    
                    <?php }?>
                </div>
                
            </section>

            <section class="sec" id="about-us">
                <h1>ABOUT US</h1>
                <div class="about-con">
                    <img src="ASSET_UKL/image/sit.avif" alt="">
                    <div>
                        <h2 class="about-title" style="text-align: left;">Welcome to QUIZ UP !</h2>
                        <p>Welcome to QuizUp, the ultimate destination for trivia lovers! We are passionate about knowledge, learning, and the thrill of competition. Whether you're a trivia novice or a seasoned expert, QuizUp is the place to challenge yourself, expand your horizons, and connect with like-minded individuals from all around the world.</p>
                    </div>
                </div>

                <div class="about-con">
                    
                    <div>
                        <h2 class="about-title" style="text-align: right;" >At Quiz UP!, </h2>
                        <p>We believe that learning should be fun and engaging. We have curated a vast collection of trivia topics, ranging from history and science to pop culture and sports. With thousands of quizzes available, you'll never run out of exciting challenges to test your knowledge.</p>
                    </div>
                    <img src="ASSET_UKL/image/ques2.jpg" alt="">
                </div>

                <div class="about-con" style="margin-bottom: 64px;" >
                    <img src="ASSET_UKL/image/ques3.webp" alt="">
                    <div>
                        
                        <p>Whether you're looking to sharpen your trivia skills, discover new interests, or connect with like-minded individuals, QuizUp is your go-to destination. So, what are you waiting for? Join the quiz revolution and embark on an exciting journey of knowledge and discovery. Get ready to challenge, compete, and </p>
                        <h2 class="about-title" style="text-align: left;" >conquer at QuizUp!</h2>
                    </div>
                    
                </div>
            </section>
        </div>
    
    </div>
    

    <script>
        let section = document.querySelectorAll('section');
        let lists = document.querySelectorAll('.list');

        let range =document.getElementById('rate');
        let pesan = document.getElementById('demo');

        let feedback =document.getElementById('feed');
        
        let count = document.getElementById('count');

        range.addEventListener('input', () => {
            pesan.innerHTML = range.value;
        });

        feedback.addEventListener('input', () => {
            count.innerHTML = feedback.value.length;
        });

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