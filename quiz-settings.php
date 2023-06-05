<?php
include('db.php');
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $sql_edit = "SELECT * FROM `kuis` WHERE id_kuis = $id";
    $result_edit = mysqli_query($host, $sql_edit);
    $row_edit = mysqli_fetch_array($result_edit);

    $id_kategori = $row_edit['id_kategori'];

    $edit_kategori = "SELECT kategori.nama_kategori, kuis.id_kuis FROM kategori INNER JOIN kuis ON kategori.id_kategori = '$id_kategori';";
    $result_edit_kategori = mysqli_query($host, $edit_kategori);
    $row_edit_kategori = mysqli_fetch_array($result_edit_kategori);

    $category = "SELECT * FROM `kategori` WHERE NOT id_kategori = '$id_kategori'" ;
    $query_category = mysqli_query($host, $category);
    
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
<body>
<h1>EDIT PAGE</h1>

<form action="" method="post" id="make_quiz">
        <div class="container1">
        <div class="container-label">
            <label for="" class="label-make-a-quiz" >QUIZ NAME</label>
            <p><?php ?></p>
            <input type="text" name="quiz-name" id="input" value="<?php echo $row_edit['nama_kuis']; ?>">
        </div>
        <div class="container-label" style="margin-left: 32px;" >
            <label for="" class="label-make-a-quiz" >NUMBERS OF QUESTION</label>
            <p><?php ?></p>
            <input type="number" name="quiz-number" id="input" value="<?php echo $row_edit['jumlah_soal']; ?>" disabled >
            <button type="button" name="create" id="add" ><a href="list-question.php?edit-question=<?php echo $id; ?>" >EDIT OR ADD QUESTION</a></button>
        </div>
        </div>
        
        <div class="container-label">
            <label for="" class="label-make-a-quiz" >CATEGORY</label>
            <select name="quiz-category" id="option" onchange="showDiv('new-input', this)">
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
            <select name="level" id="option" style="margin-bottom: 32px" >
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
        <div class="modify">
            
            <a href="deletefunc.php?delete-question=<?php echo $id; ?>" id="delete" onclick="return confirm('You sure want to delete ?')">DELETE</a>
        </div>
        <button type="submit" name="change" id="create">SAVE</button>
        <p></p>
    </form>
    <script>
        function showDiv(divId, element) {
         document.getElementById(divId).style.display = element.value == "other" ? 'block' : 'none';
        }
        // onclick="return confirm('U sure madafaka ?');"
    </script>
</body>
</html>