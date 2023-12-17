<?php
include("database_connection.php");

$serialNumber = $_GET['serial'];

$sql = "DELETE FROM `notes` WHERE `notes`.`Sr.` = $serialNumber";
$result = mysqli_query($connection, $sql);

if ($result) {
    
    header("Location: index.php?delete_status=success");
    exit();
}
