<?php
$link = mysqli_connect('localhost', 'root', '', 'sas');

$id = $_POST['id'];
$action = $_POST['action'];
$status = ($action === 'accept') ? '同意' : '拒絕';

mysqli_query($link, "UPDATE cooperation_requests SET status = '$status' WHERE id = '$id'");

header("Location: enterprise_cooperations.php");
?>
