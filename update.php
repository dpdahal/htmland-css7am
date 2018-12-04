<?php
require_once "connection.php";


if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    if (empty($name)) {
        $_SESSION['error'] = "name field is required";
        header('Location:index.php');
        exit();
    }
    $email = $_POST['email'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $language = isset($_POST['language']) ? implode(',', $_POST['language']) : '';
    $country = $_POST['country'];
    $criteria = $_POST['criteria'];

    $query = "UPDATE tbl_students SET
            name='$name',
            email='$email',
            gender='$gender',
            language='$language',
            country='$country'
            WHERE id='{$criteria}'            
            ";
    $result = mysqli_query($connection, $query);
    if ($result == true) {
        $_SESSION['success'] = 'Data was successfully updated ';
        header('Location:index.php');
        exit();
    } else {
        $_SESSION['error'] = 'There was a problem';
        header('Location:index.php');
        exit();
    }


} else {
    $_SESSION['error'] = 'Invalid access';
    header('Location:index.php');
    exit();
}