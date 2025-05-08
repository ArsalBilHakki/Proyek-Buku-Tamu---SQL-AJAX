<?php
session_start();
include("database.php");

if (!isset($_SESSION['login'])) {
    echo "Unauthorized";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $pesan = htmlspecialchars($_POST['pesan']);

    $stmt = $conn->prepare("INSERT INTO buequetaimue (neim, imeil, komen) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $email, $pesan);

    if($stmt->execute()){
        echo "Data berhasil disimpan.";
    } else {
        echo "Data gagal disimpan.";
    }

    $stmt->close();
    $conn->close();
}
?>
