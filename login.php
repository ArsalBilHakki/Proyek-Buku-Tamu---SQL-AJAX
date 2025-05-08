<?php
session_start();
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT neim, paswor FROM buequetaimue WHERE neim = ? AND paswor = ?");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['login'] = $result->fetch_assoc();
        header("Location: bukuTamu.php");
        exit();
    } else {
        echo "<script>
                alert('Login gagal. Username atau password salah.');
                window.location='index.html';
              </script>";
        exit;
    }
}
?>
