<?php
include('db.php');
if(isset($_GET['del'])){
    $id = $_GET['del'];
}

if(isset($_GET['set'])){
    $id_kuis = $_GET['set'];
}
$delete_soal = "DELETE FROM soal  WHERE id_soal = $id";
$res = mysqli_query($host, $delete_soal);
if($res){
    echo "<script> 
            alert('PERTANYAAN BERHASIL DIHAPUS');
            window.location.href = 'set-quiz.php?set=$id_kuis';
        </script>";
}
?>