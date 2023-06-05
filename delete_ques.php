<?php
include('db.php');
if(isset($_GET['del'])){
    $id = $_GET['del'];
}
$delete_soal = "DELETE FROM soal  WHERE id_soal = $id";
$res = mysqli_query($host, $delete_soal);
if($res){
    echo "<script> 
            alert('PERTANYAAN BERHASIL DIHAPUS');
            window.location.href = 'page-mentor.php';
        </script>";
}
?>