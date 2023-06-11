<?php
session_start();

error_reporting(0);
include('db.php');
if(isset($_GET['change'])){
    $id_kuis = $_GET['change'];
}

$question_error_massage = "";
$answer1_error_massage = "";
$answer2_error_massage = "";
$answer3_error_massage = "";
$answer4_error_massage = "";
$answer5_error_massage = "";
$answer6_error_massage = "";
$checkbox_error_massage = "";

if(isset($_POST['insert'])){
    $soal = $_POST['question-input'];
    $jawaban_benar = $_POST['set-true'];
    $question_type = $_POST['choose-option'];
    $option1 = $_POST['answer-input1'];
    $option2 = $_POST['answer-input2'];
    $option3 = $_POST['answer-input3'];
    $option4 = $_POST['answer-input4'];
    $option5 = $_POST['answer-input5'];
    $option6 = $_POST['answer-input6'];
    //header('location: index.php');
    if(empty(trim($soal))){
        $question_error_massage = "Please fill this field";
    }
    if(empty($jawaban_benar)){
        $checkbox_error_massage = "PLEASE SET THE CORRECT ANSWER";
    }
    if($question_type === "option"){
        if(empty(trim($option1))){
            $answer1_error_massage = "Please fill this field";
        }

        if(empty(trim($option2))){
            $answer2_error_massage = "Please fill this field";
        }

        if(empty(trim($option3))){
            $answer3_error_massage = "Please fill this field";
        }

        if(empty(trim($option4))){
            $answer4_error_massage = "Please fill this field";
        }
        if((!empty(trim($option1))) && (!empty(trim($option2))) && (!empty(trim($option3))) && (!empty(trim($option4))) && (!empty(trim($soal))) && (!empty($jawaban_benar))){
            $sql_insert = "INSERT INTO `soal`(`id_soal`, `pertanyaan`, `jawaban_benar`, `option1`, `option2`, `option3`, `option4`, `jenis_soal`, `id_kuis`) VALUES ('','$soal','$jawaban_benar','$option1','$option2','$option3','$option4','$question_type', $id_kuis)";
            $query_insert = mysqli_query($host, $sql_insert);
            if($query_insert){
                echo "<script> window.location.href = 'set-quiz.php?set=$id_kuis'; </script>";
            }
        }
    }
    
    if($question_type === "truefalse"){
        if(empty(trim($option5))){
            $answer5_error_massage = "Please fill this field";
        }

        if(empty(trim($option6))){
            $answer6_error_massage = "Please fill this field";
        }
        if((!empty(trim($option5))) && (!empty(trim($option6))) && (!empty(trim($soal))) && (!empty($jawaban_benar))){
            $sql_insert = "INSERT INTO `soal`(`id_soal`, `pertanyaan`, `jawaban_benar`, `option1`, `option2`, `option3`, `option4`, `jenis_soal`, `id_kuis`) VALUES ('','$soal','$jawaban_benar','$option5','$option6','','','$question_type', $id_kuis)";
            $query_insert = mysqli_query($host, $sql_insert);
            if($query_insert){
                echo "<script> window.location.href = 'set-quiz.php?set=$id_kuis'; </script>";
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

    .grid-answer{
        display: grid;
        justify-content: center;
        align-items: center;
        grid-template-columns: auto auto;
        gap: 32px;
        border: 3px solid #AD7BE9;
        border-radius: 24px;
        width: 85%;
        height: 488px;
        padding: 32px;
        margin-left: 50%;
        transform: translateX(-50%);
    }
    .container-label{
        display: flex;
        flex-direction: column;
        align-items: center;
        
    }
    .question-lable{
        font-size: 32px;
        color: #AD7BE9;
        margin-bottom: 32px;
    }
    .input-question{
        resize: none;
        width: 95%;
        height: 64px;
        padding-top: 32px;
        border-radius: 24px;
        border: 3px solid #AD7BE9;
        outline: 3px solid #AD7BE9;
        text-align: center;
        font-family: 'Share Tech Mono', monospace;
        font-size: 24px;
        margin-bottom: 32px;
        transition: 0.2s;
    }

    .input-question:focus{
        outline-offset: 6px;
    }

    .input-answer::-webkit-scrollbar, .input-question::-webkit-scrollbar{
        display: none;
    }

    .input-answer{
        resize: none;
        width: 764px;
        height: 100px;
        padding: 16px;
        border-radius: 24px;
        text-align: center;
        font-family: 'Share Tech Mono', monospace;
        font-size: 24px;
    }
    .container-option{
        display: flex;
        justify-content: center;
        align-items: center;

        margin-top: 32px;
    }

    h1{
        font-size: 84px;
        margin-top: 64px;
        color: #3E54AC;
        text-align: center;
    }

    .minus{
        width: 32px;
        height: 32px;
        border-radius: 16px;
        border: none;
        font-family: 'Share Tech Mono', monospace;
        background-color: #AD7BE9; 
        color: #FFFFFF;
        font-size: 24px;
    }

    .label-question-type{
        font-size: 24px;
        color: #3E54AC;
        margin-right: 16px;
    }

    .radio-container{
        display: flex;
        align-items: center;
        justify-content: center;
        width: 240px;
        height: 48px;
        border: 3px solid #AD7BE9;
        border-radius: 16px;
        accent-color: #AD7BE9;
        margin-right: 16px;
    }
    
    .option{
        margin-right: 16px;
    }

    #insert{
        width: 240px;
        height: 48px;
        border: 3px solid #AD7BE9;
        border-radius: 16px;
        font-family: 'Share Tech Mono', monospace;
        background-color: #AD7BE9; 
        color: #FFFFFF;
        font-size: 24px;
        margin-top: 32px;
        margin-left: 50%;
        transform: translateX(-50%);
    }
    .checkbox-container{
        width: 32px;
        margin-left: 764px;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 16px;
        
    }

    #mark1{
        width: 246px;
        height: 16px;
        padding: 8px;
        border-radius: 16px;
        font-family: 'Share Tech Mono', monospace;
        background-color: #00A36C;
        color: #FFFFFF;
        font-size: 16px;
        position: absolute;
        top: -16px;
        display: none;
        animation-name: enter;
        animation-duration: 0.2s;
        animation-timing-function: ease-in-out;
        
    }

    #mark2{
        width: 246px;
        height: 16px;
        padding: 8px;
        border-radius: 16px;
        font-family: 'Share Tech Mono', monospace;
        background-color: #00A36C;
        color: #FFFFFF;
        font-size: 16px;
        position: absolute;
        top: -16px;
        display: none;
        animation-name: enter;
        animation-duration: 0.2s;
        animation-timing-function: ease-in-out;
        
    }

    #mark3{
        width: 246px;
        height: 16px;
        padding: 8px;
        border-radius: 16px;
        font-family: 'Share Tech Mono', monospace;
        background-color: #00A36C;
        color: #FFFFFF;
        font-size: 16px;
        position: absolute;
        top: 216px;
        display: none;
        animation-name: enter;
        animation-duration: 0.2s;
        animation-timing-function: ease-in-out;
        
    }

    #mark4{
        width: 246px;
        height: 16px;
        padding: 8px;
        border-radius: 16px;
        font-family: 'Share Tech Mono', monospace;
        background-color: #00A36C;
        color: #FFFFFF;
        font-size: 16px;
        position: absolute;
        top: 216px;
        display: none;
        animation-name: enter;
        animation-duration: 0.2s;
        animation-timing-function: ease-in-out;
        
    }
    #mark5{
        width: 246px;
        height: 16px;
        padding: 8px;
        border-radius: 16px;
        font-family: 'Share Tech Mono', monospace;
        background-color:  #00A36C;
        color: #FFFFFF;
        font-size: 16px;
        position: absolute;
        top: 64px;
        display: none;
        animation-name: enter;
        animation-duration: 0.2s;
        animation-timing-function: ease-in-out;
        
    }

    #mark6{
        width: 246px;
        height: 16px;
        padding: 8px;
        border-radius: 16px;
        font-family: 'Share Tech Mono', monospace;
        background-color:  #00A36C;
        color: #FFFFFF;
        font-size: 16px;
        position: absolute;
        top: 64px;
        display: none;
        animation-name: enter;
        animation-duration: 0.2s;
        animation-timing-function: ease-in-out;
        
    }

    .set-true{
        accent-color: #AFE1AF;
        width: 32px;
        height: 32px;
    }

    .err{
        color: red;
    }

    @keyframes enter{
        0%{
            opacity: 0;
            transform: translateY(-20px) scale(0.9);
        }
        100%{
            opacity: 1;
            transform: translateY(0px) scale(1);
        }
    }

</style>
<body>
    <h1>QUESTION</h1>
<form action="" method="post">
    <div class="container-label">
            <p class="err" ><?php echo $checkbox_error_massage; ?></p>
            <label for="pertanyaan" class="question-lable" >QUESTION</label>
            <p class="err" ><?php echo $question_error_massage; ?></p>
            <textarea name="question-input" cols="50" rows="10" class="input-question"></textarea>
    </div>
    <div class="grid-answer" id="container">
        <div class="answer-container" id="1" >
            <div class="checkbox-container">
                <span id="mark1">MAKE THIS THE CORRECT ANSWER</span>
                <input type="checkbox" class="set-true" value="1" onclick="checkedOnClick(this);" onmouseover="showTip1()" onmouseout="hideTip1()" name="set-true">
            </div>
            <p class="err" ><?php echo $answer1_error_massage; ?></p>
            <textarea name="answer-input1" cols="50" rows="10" class="input-answer" ></textarea>
        </div>
        <div class="answer-container" id="2" >
            <div class="checkbox-container">
                <span id="mark2">MAKE THIS THE CORRECT ANSWER</span>
                <input type="checkbox" class="set-true" value="2" onclick="checkedOnClick(this);" onmouseover="showTip2()" onmouseout="hideTip2()" name="set-true">
            </div>
            <p class="err" ><?php echo $answer2_error_massage; ?></p>
            <textarea name="answer-input2" cols="50" rows="10" class="input-answer" ></textarea>
        </div>
        <div class="answer-container" id="3">
            <div class="checkbox-container">
                <span id="mark3">MAKE THIS THE CORRECT ANSWER</span>
                <input type="checkbox" class="set-true" value="3" onclick="checkedOnClick(this);" onmouseover="showTip3()" onmouseout="hideTip3()" name="set-true">
            </div>
            <p class="err" ><?php echo $answer3_error_massage; ?></p>
            <textarea name="answer-input3" cols="50" rows="10" class="input-answer" ></textarea>
        </div>
        <div class="answer-container" id="4" >
            <div class="checkbox-container">
                <span id="mark4">MAKE THIS THE CORRECT ANSWER</span>
                <input type="checkbox" class="set-true" value="4" onclick="checkedOnClick(this);" onmouseover="showTip4()" onmouseout="hideTip4()" name="set-true">
            </div>
            <p class="err" ><?php echo $answer4_error_massage; ?></p>
            <textarea name="answer-input4" cols="50" rows="10" class="input-answer" ></textarea>
        </div>
        <div class="answer-container" id="5" style="display:none;" >
            
            <div class="checkbox-container">
                <span id="mark5">MAKE THIS THE CORRECT ANSWER</span>
                <input type="checkbox" class="set-true" value="5" onclick="checkedOnClick(this);" onmouseover="showTip5()" onmouseout="hideTip5()" name="set-true" >
            </div>
            <p id="err" ><?php echo $answer5_error_massage; ?></p>
            <textarea name="answer-input5" cols="50" rows="10" class="input-answer" ></textarea>
        </div>
        <div class="answer-container" id="6" style="display:none;" >
            
            <div class="checkbox-container">
                <span id="mark6">MAKE THIS THE CORRECT ANSWER</span>
                <input type="checkbox" class="set-true" value="6" onclick="checkedOnClick(this);" onmouseover="showTip6()" onmouseout="hideTip6()" name="set-true">
            </div>
            <p class="err" ><?php echo $answer6_error_massage; ?></p>
            <textarea name="answer-input6" cols="50" rows="10" class="input-answer" ></textarea>
        </div>
        <p id="err" ><?php echo $checkbox_error_massage; ?></p>
    </div>

    <div class="container-option" >
        <label for="" class="label-question-type" >QUESTION TYPE</label>
        <div class="radio-container">
        <input type="radio" name="choose-option" id="true-false" class="option" value="truefalse" ><label for="" class="label-question-type" >TRUE OR FALSE</label>
        </div>
        <div class="radio-container">
        <input type="radio" name="choose-option" id="option" class="option" value="option" checked ><label for="" class="label-question-type" >OPTION</label>
        </div>
    </div>
    <button type="submit" name="insert" id="insert" >INSERT QUESTION</button>
</form>

<script>
    var true_false = document.getElementById("true-false");
    var option =document.getElementById('option');
    var op1 = document.getElementById('1');
    var op2 = document.getElementById('2');
    var op3 = document.getElementById('3');
    var op4 = document.getElementById('4');
    var op5 = document.getElementById('5');
    var op6 = document.getElementById('6');

    true_false.addEventListener('click', function(){
        if(true_false.checked == true){
            op1.style.display = "none";
            op2.style.display = "none";
            op3.style.display = 'none';
            op4.style.display = 'none';
            op5.style.display = 'block';
            op6.style.display = 'block';

            op5.children[2].value = 'TRUE';
            op6.children[2].value = 'FALSE';
            }
    });

    option.addEventListener('click', function(){
        if(option.checked == true){
            op1.style.display = "block";
            op2.style.display = "block";
            op3.style.display = 'block';
            op4.style.display = 'block';
            op5.style.display = 'none';
            op6.style.display = 'none';

            op5.children[2].value = '';
            op6.children[2].value = '';
            }
    });

    

    function checkedOnClick(el){
        var checkboxesList = document.getElementsByClassName("set-true");
        for (var i = 0; i < checkboxesList.length; i++) {
           checkboxesList.item(i).checked = false; 
        }

        el.checked = true; 
    }

    function showTip1() {
        var tip = document.getElementById("mark1");
        tip.style.display = "block";
    }
    function hideTip1() {
        var tip = document.getElementById("mark1");
        tip.style.display = "none";
    }
    function showTip2() {
        var tip = document.getElementById("mark2");
        tip.style.display = "block";
    }
    function hideTip2() {
        var tip = document.getElementById("mark2");
        tip.style.display = "none";
    }
    function showTip3() {
        var tip = document.getElementById("mark3");
        tip.style.display = "block";
    }
    function hideTip3() {
        var tip = document.getElementById("mark3");
        tip.style.display = "none";
    }
    function showTip4() {
        var tip = document.getElementById("mark4");
        tip.style.display = "block";
    }
    function hideTip4() {
        var tip = document.getElementById("mark4");
        tip.style.display = "none";
    }
    function showTip5() {
        var tip = document.getElementById("mark5");
        tip.style.display = "block";
    }
    function hideTip5() {
        var tip = document.getElementById("mark5");
        tip.style.display = "none";
    }

    function showTip6() {
        var tip = document.getElementById("mark6");
        tip.style.display = "block";
    }
    function hideTip6() {
        var tip = document.getElementById("mark6");
        tip.style.display = "none";
    }

</script>
<?php

?>
</body>
</html>