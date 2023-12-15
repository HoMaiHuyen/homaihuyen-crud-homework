<?php 
require_once "database/database.php"; 

$db = db();
if (isset($_GET['id'])) {
    $studentId = $_GET['id'];
    echo $studentId;
    deleteStudent($studentId);
}
header("location:index.php");
?>