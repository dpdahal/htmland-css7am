<?php
session_start();
$connection = mysqli_connect('127.0.0.1', 'root', '', 'php8am');

if (!$connection) {
    die(mysqli_errno($connection));
}