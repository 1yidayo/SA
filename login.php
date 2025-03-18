<?php
session_start();
$conn = new mysqli("localhost", "root", "", "test1");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT role FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("users", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $_SESSION['role'] = $row['role'];
        header("Location: welcome.php");
        exit();
    } else {
        echo "<script>alert('帳號不存在，請先註冊！'); window.location.href='register.html';</script>";
    }
}
?>

