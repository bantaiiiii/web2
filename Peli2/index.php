<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Utama Pengguna </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-image: url(images/OIP.jpg);
}
-->
</style></head>
<body>
    <h1>Daftar Pengguna</h1>
    <a href="pengguna.php">Kelola Pengguna</a>
    <br><br>

    <?php
    // Ambil data pengguna dari database
    $sql = "SELECT * FROM Pengguna";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>NIK</th><th>Nama</th><th>Email</th><th>HP</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['NIK']."</td>";
            echo "<td>".$row['Nama']."</td>";
            echo "<td>".$row['Email']."</td>";
            echo "<td>".$row['HP']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada data pengguna.";
    }

    $conn->close();
    ?>
</body>
</html>
