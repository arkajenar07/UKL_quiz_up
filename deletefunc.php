<?php
    include('db.php');
    if(isset($_GET['delete-question'])){
        $id = $_GET['delete-question'];
    }
    /*$sql_del = "DELETE FROM `kuis` WHERE id_kuis = $id";
    $result = mysqli_query($host, $sql_del);
    if($result){
        echo "TRUE";
    }else{
        echo "FALSE";
    }*/
        $delete_soal = "DELETE FROM `soal`  WHERE id_kuis = $id";
        $res = mysqli_query($host, $delete_soal);
        if($res){
            $delete_history = "DELETE FROM `quiz_pengguna` WHERE id_kuis = $id";
            $result = mysqli_query($host, $delete_history);
            if($result){
                $sql_delete = "DELETE FROM `kuis` WHERE id_kuis = $id";
                $res_del = mysqli_query($host, $sql_delete);
                if($res_del){
                    echo "<script> 
                    alert('QUIZ BERHASIL DIHAPUS');
                    window.location.href = 'page-mentor.php';
                    </script>";

                }else{
                    echo "FALSE NO";
                }
            }
            
        }
    
?>