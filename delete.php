<?php
require_once "connection.php";

if (!empty($_GET) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    if ((int)$_GET['criteria']) {
        $id = $_GET['criteria'];
        $query = "DELETE FROM tbl_students WHERE id='{$id}'";
        $result = mysqli_query($connection, $query);
        if($result==true){
            $_SESSION['success'] = 'Data was successfully deleted';
            header('Location:index.php');
            exit();
        }else{
            $_SESSION['error'] = 'There was a problem';
            header('Location:index.php');
            exit();
        }

    } else {
        $_SESSION['error'] = 'Invalid Criteria';
        header('Location:index.php');
        exit();
    }

} else {
    $_SESSION['error'] = 'Invalid Access';
    header('Location:index.php');
    exit();
}