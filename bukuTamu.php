<?php

session_start();
include("database.php");

if (!isset($_SESSION['login'])) {
    header("Location: index.html");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Halaman Buku Tamu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Buku Tamu</header>
            <form id="guestForm">
                <div class="field input">
                    <label>Nama</label>
                    <input type="text" name="nama" required>
                </div>
                <div class="field input">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="field input">
                    <label>Pesan</label>
                    <textarea name="pesan" required rows="4" style="resize: none; border-radius: 5px; padding: 5px;"></textarea>
                </div>
                <div class="field">
                    <input type="submit" class="btn" value="Kirim">
                </div>
            </form>

            <br><hr><br>

            <h3>Buku Tamu:</h3><br>
            <div id="responseMessage"></div>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Pesan</th>
                    </tr>
                </thead>
                <tbody id="guestbookTable">
                <?php
                    include("database.php");
                    $sql = "SELECT neim, imeil, komen FROM buequetaimue";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $count . "</td>";
                            echo "<td>" . htmlspecialchars($row['neim']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['imeil']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['komen']) . "</td>";
                            echo "</tr>";
                            $count++;
                        }
                    } else {
                        echo "<tr><td colspan='4'>Data tidak ditemukan</td></tr>";
                    }
                    $conn->close();
                ?>
                </tbody>
            </table>

            <div class="field">
                <br><a href="logout.php" class="btn">Logout</a>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('guestForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        fetch('submitGuest.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('responseMessage').innerHTML = data;
            location.reload();
        })
        .catch(error => console.error('Error:', error));
    });
    </script>
</body>
</html>
