<?php
include('db.php');
if(isset($_GET['edit-question'])){
    $id_kuis = $_GET['edit-question'];
    $select_question = "SELECT * FROM `soal` WHERE id_kuis = $id_kuis;";
    $result_question = mysqli_query($host, $select_question);
     
}
$nomor = 1;
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
<body>
<h1>EDIT PAGE</h1>
<?php while($row_question = mysqli_fetch_array($result_question)){ ?>
    <h1>QUESTION NUMBER <?php echo $nomor; ?></h1>
    <pre><?php echo $row_question['pertanyaan']; ?></pre>
    <?php $nomor++;} ?>
</body>
</html>