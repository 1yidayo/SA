<?php
session_start();
$link = mysqli_connect('localhost', 'root', '', 'sas');

if ($_SESSION['level'] !== 'cl') {
  exit("未授權的操作");
}

$club_identityID = $_SESSION['identityID'];
$enrequirement_num = $_POST['enrequirement_num'];
$enterprise_identityID = $_POST['enterprise_identityID'];

// 防止重複申請
$check = "SELECT * FROM cooperation_requests 
          WHERE club_identityID = '$club_identityID' 
          AND enrequirement_num = '$enrequirement_num'";
$result = mysqli_query($link, $check);

if (mysqli_num_rows($result) == 0) {
  $insert = "INSERT INTO cooperation_requests 
    (club_identityID, enterprise_identityID, enrequirement_num)
    VALUES ('$club_identityID', '$enterprise_identityID', '$enrequirement_num')";
  mysqli_query($link, $insert);
}

header("Location: properties2.php");
?>
