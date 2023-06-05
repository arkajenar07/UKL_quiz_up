<?php
session_start();
include('db.php');

$category = "SELECT * FROM `kategori`" ;
$query_category = mysqli_query($host, $category);

$pembuat = $_SESSION['username_email'];

$quizname_error_massage = "";
$quiznumber_error_massage= "";


if(isset($_POST['create'])){
    $nama_quiz = $_POST['quiz-name'];
    $kategori = $_POST['quiz-category'];
    $level = $_POST['level'];

    if(empty(trim($nama_quiz))){
        $quizname_error_massage = "Please fill this field";
    }

    if(!empty(trim($nama_quiz))){

        $get_id_pembuat = "SELECT * FROM `pengguna` WHERE username = '$pembuat'";
        $query_id_pembuat = mysqli_query($host, $get_id_pembuat);
        $row_id_pembuat = mysqli_fetch_array($query_id_pembuat);
        $id_pembuat = $row_id_pembuat['id_user'];

        if($kategori === "other"){
            $new_kategori = $_POST['quiz-new-category'];

            $insert_new_category = "INSERT INTO `kategori`(`id_kategori`, `nama_kategori`) VALUES ('','$new_kategori')";
            $query_new_kategori = mysqli_query($host, $insert_new_category);
            
            if($query_new_kategori){

                $new_kategori = strtoupper($new_kategori);
                $get_id_kategori = "SELECT * FROM `kategori` WHERE nama_kategori = '$new_kategori'";
                $query_id_kategori = mysqli_query($host, $get_id_kategori);
                $row_id_kategori = mysqli_fetch_array($query_id_kategori);
                $id_kategori = $row_id_kategori['id_kategori'];

                $create_quiz = "INSERT INTO `kuis` (`id_kuis`, `nama_kuis`, `id_pembuat`, `id_kategori`, `level`) VALUES ('','$nama_quiz','$id_pembuat','$id_kategori','$level')";
                $query_create_quiz = mysqli_query($host, $create_quiz);
                if($query_create_quiz){
                    $id_kuis = mysqli_insert_id($host);

                    echo "<script> alert('Quiz berhasil dibuat');
                    window.location.href = 'set-quiz.php?set=$id_kuis';
                    </script>";
                } else{
                    "<script>
                    alert('GAGAL');
                    </script>";
                }

            }

        }
        if($kategori != "other"){
            $get_id_kateg = "SELECT * FROM `kategori` WHERE nama_kategori = '$kategori'";
            $query_id_kateg = mysqli_query($host, $get_id_kateg);
            $row_id_kateg = mysqli_fetch_array($query_id_kateg);
            $id_category = $row_id_kateg['id_kategori'];

            $create_kuis = "INSERT INTO `kuis` (`id_kuis`, `nama_kuis`, `id_pembuat`, `id_kategori`, `level`) VALUES ('','$nama_quiz','$id_pembuat','$id_category','$level')";
            $query_create_kuis = mysqli_query($host, $create_kuis);
            if($query_create_kuis){
                $id_quiz = mysqli_insert_id($host);
                echo "<script> alert('Quiz berhasil dibuat');
                    window.location.href = 'set-quiz.php?set=$id_quiz';
                    </script>";
            } else{
                "<script>
                alert('GAGAL');
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
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    h1{
        font-size: 84px;
        margin-top: 64px;
        color: #3E54AC;
    }

    p{
        color: red;  
        font-size: 20px
    }

    .container1{
        display: flex;
    }

    #make_quiz{
        width: 1000px;
        height: auto;
        margin-top: 64px;
        border-radius: 36px;
        border: 3px solid #AD7BE9;
        background-color: #FFFFFF;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .container-label{
        margin-top: 64px;
        display: flex;
        flex-direction: column;
    }
    .new-input{
        margin-top: 64px;
        margin-left: 64px;
        display: flex;
        flex-direction: column;
    }

    #input{
        width: 824px;
        height: 64px;
        border-radius: 16px;
        padding-left: 32px;
        padding-right: 16px;
        border: 1.5px solid #AD7BE9;
        outline: 1.5px solid #AD7BE9;
        font-family: 'Share Tech Mono', monospace;
        font-size: 24px;
    }

    #input-new{
        width: 824px;
        height: 64px;
        border-radius: 16px;
        padding-left: 32px;
        padding-right: 16px;
        border: 1.5px solid #AD7BE9;
        outline: 1.5px solid #AD7BE9;
        font-family: 'Share Tech Mono', monospace;
        font-size: 24px;
    }

    .label-make-a-quiz{
        font-size: 32px;
        color: #AD7BE9;
    }

    #option{
        width: 872px;
        height: 64px;
        font-family: 'Share Tech Mono', monospace;
        font-size: 24px;
        color: #694E8A;
        border: 1.5px solid #AD7BE9;
        border-radius: 16px;
        padding-left: 32px;
        outline: 1.5px solid #AD7BE9;
        
    }

    #create{
        width: 240px;
        height: 60px;
        background-color: #AD7BE9;
        font-family: 'Share Tech Mono', monospace;
        font-size: 24px;
        color: #FFFFFF;
        margin-bottom: 32px;
    }
</style>
<body>
    <h1>MAKE A QUIZ</h1>
    <form action="" method="post" id="make_quiz">
        
        <div class="container-label">
            <label for="" class="label-make-a-quiz" >QUIZ NAME</label>
            <p><?php echo $quizname_error_massage; ?></p>
            <input type="text" name="quiz-name" id="input" >
        </div>
        
        <div class="container-label">
            <label for="" class="label-make-a-quiz" >CATEGORY</label>
            <select name="quiz-category" id="option" onchange="showDiv('new-input', this)">
            <?php while ($row_category = mysqli_fetch_array($query_category)) {?>
                <option value="<?php echo $row_category['nama_kategori']; ?>"><?php echo $row_category['nama_kategori']; ?></option>
                <?php } ?>
                <option value="other">other</option>
            </select>
        </div>
        <div class="new-input" id="new-input" style="display:none;">
            <label for="" class="label-make-a-quiz" >KATEGORI BARU</label>
            <input type="text" name="quiz-new-category" id="input-new">
        </div>
        <div class="container-label">
        <label for="" class="label-make-a-quiz" >LEVEL</label>
            <select name="level" id="option" style="margin-bottom: 32px" >
                <option value="easy">EASY</option>
                <option value="medium">MEDIUM</option>
                <option value="hard">HARD</option>
            </select>
        </div>
        <button type="submit" name="create" id="create" >CREATE</button>
        <p></p>
    </form>
    <script>
        function showDiv(divId, element) {
         document.getElementById(divId).style.display = element.value == "other" ? 'block' : 'none';
        }
        
    </script>
</body>

</html>