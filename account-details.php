<?php
session_start();
include('db.php');
$uname = $_SESSION['username_email'];
echo $uname;
$sql = "SELECT * FROM `pengguna` WHERE username = '$uname'";
$result = mysqli_query($host, $sql);
$row = mysqli_fetch_array($result);

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: index.php");
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
    <form action="" method="post">
    <h1>ACCOUNT DETAILS</h1>
    <h1>USERNAME</h1>
    <input type="text" name="uname" id="" value="<?php echo $row['username'] ?>" disabled>
    <h1>JENIS USER</h1>
    <h3><?php echo strtoupper($row['jenis_user']); ?></h3>
    <button type="submit" name="logout">LOG OUT</button>
    </form>
</body>
</html>