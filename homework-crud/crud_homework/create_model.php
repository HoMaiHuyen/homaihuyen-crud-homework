<?php
require_once "database/database.php";

$db = db();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['name']) && !empty($_POST['age']) && !empty($_POST['email']) && !empty($_POST['image_url'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $profile = $_POST['image_url'];
    createStudent($name, $age, $email, $profile);
}
header('location: index.php');
