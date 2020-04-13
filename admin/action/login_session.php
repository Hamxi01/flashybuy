<?php 
        include('../../includes/db.php');

if (isset($_POST['admin-login'])) {

    $name = $_POST['name'];
    $pass = md5($_POST['password']);

    $sql   = "SELECT * FROM admin where name ='$name' AND password ='$pass'";
    $query = mysqli_query($con,$sql);
    $rows  = mysqli_num_rows($query);

    if ($rows > 0) {

        session_start();
        $_SESSION['username'] = $_POST['name'];
        header('Location:../index.php');
    }
    else{

      header("Location:../login.php?msg=error");
    }
          
}        
































?>