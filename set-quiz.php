<?php
session_start();
include('db.php');
if(isset($_GET['set'])){
    $id = $_GET['set'];
}

$sql_edit = "SELECT * FROM `kuis` WHERE id_kuis = $id";
$result_edit = mysqli_query($host, $sql_edit);
$row_edit = mysqli_fetch_array($result_edit);

$id_kategori = $row_edit['id_kategori'];

$edit_kategori = "SELECT kategori.nama_kategori, kuis.id_kuis FROM kategori INNER JOIN kuis ON kategori.id_kategori = '$id_kategori';";
$result_edit_kategori = mysqli_query($host, $edit_kategori);
$row_edit_kategori = mysqli_fetch_array($result_edit_kategori);

$category = "SELECT * FROM `kategori` WHERE NOT id_kategori = '$id_kategori'" ;
$query_category = mysqli_query($host, $category);

$sql_select_question = "SELECT * FROM `soal` WHERE id_kuis = $id";
$result_select_question = mysqli_query($host, $sql_select_question);
$count_question = mysqli_num_rows($result_select_question);

$nomor = 1;
$ques_num = 1;
if(isset($_POST['change'])){
    $nama_quiz = $_POST['quiz-name'];
    $kategori = $_POST['quiz-category'];
    $level = $_POST['level'];

    if(empty(trim($nama_quiz))){
        $quizname_error_massage = "Please fill this field";
    }

    if(!empty(trim($nama_quiz))){

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

                $create_quiz = "UPDATE `kuis` SET `nama_kuis`='$nama_quiz',`id_kategori`='$id_kategori',`level`='$level' WHERE id_kuis = $id";
                $query_create_quiz = mysqli_query($host, $create_quiz);
                if($query_create_quiz){

                    echo "<script> alert('Quiz berhasil di simpan');
                    window.location.href = 'page-mentor.php';
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

            $create_kuis = "UPDATE `kuis` SET `nama_kuis`='$nama_quiz',`id_kategori`='$id_category',`level`='$level' WHERE id_kuis = $id";
            $query_create_kuis = mysqli_query($host, $create_kuis);
            if($query_create_kuis){
                echo "<script> alert('Quiz berhasil di simpan');
                    window.location.href = 'page-mentor.php';
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
        
    }

    .con{
        display: flex;
        flex-direction: row;
    }

    h1, .ques-list-title{
        font-size: 48px;
        margin-top: 32px;
        color: #3E54AC;
    }

    .err{
        color: red;  
        font-size: 20px;
    }

    .container1{
        display: flex;
    }

    #make_quiz{

        position: fixed;
        width: 700px;
        height: 720px;
        margin-left: 384px;
        margin-top: 96px;
        border-radius: 36px;
        border: 3px solid #AD7BE9;
        background-color: #FFFFFF;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #ques-form{
        margin-left: 1084px;
    }

    .container-label{
        margin-top: 32px;
        display: flex;
        flex-direction: column;
    }
    .new-input{
        margin-top: 64px;
        margin-left: 48px;
        display: flex;
        flex-direction: column;
    }

    #input{
        width: 556px;
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
        width: 556px;
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

    .option{
        width: 604px;
        height: 64px;
        font-family: 'Share Tech Mono', monospace;
        font-size: 24px;
        color: #694E8A;
        border: 1.5px solid #AD7BE9;
        border-radius: 16px;
        padding-left: 32px;
        outline: 1.5px solid #AD7BE9;
        
    }

    #save{
        width: 240px;
        height: 60px;
        background-color: #AD7BE9;
        font-family: 'Share Tech Mono', monospace;
        font-size: 24px;
        color: #FFFFFF;
        margin-bottom: 16px;
    }

    #del{
        width: 240px;
        height: 60px;
        background-color: #FFFFFF;
        font-family: 'Share Tech Mono', monospace;
        border: 2px solid #AD7BE9;
        margin-bottom: 16px;
    }

    #del a{
        font-size: 24px;
        color: red;
        text-decoration: none;
    }

    .ques-title{
        color: #694E8A;
    }

    .question{
        font-size: 20px;
        margin-bottom: 24px;
        margin-top: 24px;
    }

    .ques-con{
        margin-left: 64px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .ques{
        width: 540px;
        border: 2px solid #AD7BE9;
        padding: 16px;
        margin-top: 32px;

    }

    .answer-con{
        border: 2px solid #AD7BE9;
        display: grid;
        grid-template-columns: auto auto;
        padding:24px;
        gap:16px;
    }

    .icon-del{
        width: 32px;
    }

    .del-btn{
        width: max-content;
        background: none;
        border: none; 
    }

    .del-con{
        margin-top: 32px;
        display: flex;
        justify-content: center;
    }

    .add-ques-btn{
        margin-top: 32px;
        margin-bottom: 32px;
        width: 240px;
        height: 50px;
        background-color: #694E8A;
        border-radius: 28px;
        outline: 1px solid #FFFFFF;
        transition: 0.2s;   
        color: #FFFFFF;
        font-size: 24px;
        font-family: 'Share Tech Mono', monospace;
    }

    .add-ques-btn:hover{
        background-color: #543E6A;
    }

    .rad-inp{
        margin-right: 8px;
        accent-color: #AD7BE9;
    }
</style>
<body>
<h1 style="margin-bottom: 32px; text-align: center;" >QUIZ SETTINGS</h1>
<div class="con">
<form action="" method="post" id="make_quiz">
    <h1>EDIT QUIZ DETAILS</h1>
        <div class="container-label">
            <label for="" class="label-make-a-quiz" >QUIZ NAME</label>
            <p><?php ?></p>
            <input type="text" name="quiz-name" id="input" value="<?php echo $row_edit['nama_kuis']; ?>">
        </div>

        
        <div class="container-label">
            <label for="" class="label-make-a-quiz" >CATEGORY</label>
            <select name="quiz-category" class="option" onchange="showDiv('new-input', this)">
            <option value="<?php echo $row_edit_kategori['nama_kategori']; ?>" ><?php echo $row_edit_kategori['nama_kategori']; ?></option>
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
            <select name="level" class="option" style="margin-bottom: 32px" >
                <option value="<?php echo $row_edit['level']; ?>"><?php echo strtoupper($row_edit['level']); ?></option>
                <option value="<?php if($row_edit['level'] === "easy"){
                        echo "medium";
                    } else if($row_edit['level'] === "medium" || $row_edit['level'] === "hard"){
                        echo "easy";
                    }
                    ?>">
                    <?php if($row_edit['level'] === "easy"){
                        echo "MEDIUM";
                    } else if($row_edit['level'] === "medium" || $row_edit['level'] === "hard"){
                        echo "EASY";
                    }
                    ?>
                </option>
                <option value="<?php if($row_edit['level'] === "easy" || $row_edit['level'] === "medium"){
                        echo "hard";
                    } else if($row_edit['level'] === "hard"){
                        echo "medium";
                    }
                    ?>">
                    <?php if($row_edit['level'] === "easy" || $row_edit['level'] === "medium"){
                        echo "HARD";
                    } else if($row_edit['level'] === "hard"){
                        echo "MEDIUM";
                    }
                    ?>
                </option>
            </select>
        </div>

        <button type="submit" name="change" id="save">SAVE</button>    
        <button  id="del"><a href="deletefunc.php?delete-question=<?php echo $id; ?>" id="delete" onclick="return confirm('You sure want to delete ?')">DELETE</a></button>
    </form>
    <form action="" method="post" id="ques-form" >
        <div class="ques-con">
        <h2 class="ques-list-title" >QUESTION LIST</h2>
            <?php if($count_question > 0){
                while ($row_select_question = mysqli_fetch_array($result_select_question)) {
                    $id_ques = $row_select_question['id_soal'];
                ?>
            
            <div class="ques" >
                <h2 class="ques-title">QUESTION <?php echo $nomor; ?></h2>
                <p class="question"><?php echo $row_select_question['pertanyaan']; ?></p>
                <?php if($row_select_question['jenis_soal'] == "option"){ ?>
                <div class="answer-con">
                
                <div class="inp-con"><input type="radio" name="answer<?php echo $nomor; ?>" id="" class="rad-inp" <?php if($row_select_question['jawaban_benar'] == 1){echo "checked";} ?> ><?php echo $row_select_question['option1']; ?></div>
                <div class="inp-con"><input type="radio" name="answer<?php echo $nomor; ?>" id="" class="rad-inp" <?php if($row_select_question['jawaban_benar'] == 2){echo "checked";} ?> ><?php echo $row_select_question['option2']; ?></div>
                <div class="inp-con"><input type="radio" name="answer<?php echo $nomor; ?>" id="" class="rad-inp" <?php if($row_select_question['jawaban_benar'] == 3){echo "checked";} ?> ><?php echo $row_select_question['option3']; ?></div>
                <div class="inp-con"><input type="radio" name="answer<?php echo $nomor; ?>" id="" class="rad-inp" <?php if($row_select_question['jawaban_benar'] == 4){echo "checked";} ?> ><?php echo $row_select_question['option4']; ?></div>
                </div>
                <div class="del-con"><button type="button" class="del-btn" ><a href="delete_ques.php?del=<?php echo $id_ques; ?>&set=<?php echo $id; ?>" id="delete" onclick="return confirm('You sure want to delete ?')"><img class="icon-del" src="ASSET_UKL/icon/red-icon/TRASH.png" alt=""></a></button></div>

            <?php 
            }

            if($row_select_question['jenis_soal'] == "truefalse"){?>
                <div class="answer-con">
                <div class="inp-con"><input type="radio" name="answer<?php echo $nomor; ?>" id="" class="rad-inp" <?php if($row_select_question['jawaban_benar'] == 5){echo "checked";} ?> ><?php echo $row_select_question['option1']; ?></div>
                <div class="inp-con"><input type="radio" name="answer<?php echo $nomor; ?>" id="" class="rad-inp" <?php if($row_select_question['jawaban_benar'] == 6){echo "checked";} ?> ><?php echo $row_select_question['option2']; ?></div>
                
                </div>
                <div class="del-con"><button type="button" class="del-btn" ><a href="delete_ques.php?del=<?php echo $id_ques; ?>&set=<?php echo $id; ?>" id="delete" onclick="return confirm('You sure want to delete ?')"><img class="icon-del" src="ASSET_UKL/icon/red-icon/TRASH.png" alt=""></a></button></div>
        <?php } ?> 
            </div>
        <?php
        $nomor++;
        $sql_update = "UPDATE `soal` SET `nomor`='$ques_num' WHERE id_soal = $id_ques";
        $result_update = mysqli_query($host, $sql_update);
        
        $ques_num++;

        

        }
        ?>
        <a href="insert-question.php?change=<?php echo $id; ?>"><button type="button" class="add-ques-btn">ADD QUESTION</button></a>
        </div>
    <?php } else{?>
        <h2>NO QUESTION FOUND, ADD ONE</h2>
        <a href="insert-question.php?change=<?php echo $id; ?>"><button type="button" class="add-ques-btn">ADD QUESTION</button></a>
    <?php }?>
    </form>
</div>

    <script>
        function showDiv(divId, element) {
         document.getElementById(divId).style.display = element.value == "other" ? 'block' : 'none';
        }
        // onclick="return confirm('U sure madafaka ?');"
    </script>
</body>
</html>