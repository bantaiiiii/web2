<?php
include 'koneksi.php';

// Proses Tambah Pengguna
if(isset($_POST['submit'])) {
    $NIK = $_POST['nik'];
    $Nama = $_POST['nama'];
    $Email = $_POST['email'];
    $HP= $_POST['hp'];

    // Query untuk menyimpan data pengguna baru
    $sql = "INSERT INTO pengguna (NIK, Nama, Email, HP) VALUES ('$NIK', '$Nama', '$ Email', '$HP')";

    if ($conn->query($sql) === TRUE) {
        echo "Data pengguna berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Ambil data pengguna dari database untuk ditampilkan
$sql = "SELECT * FROM Pengguna";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Pengguna - PeLi</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-image: url(images/OIP.jpg);
}
-->
</style></head>
<body>
    <h1 align="center">Kelola Pengguna</h1>
    <div align="right"><a href="navbar.php">Kembali ke halaman utama </a>
        <br>
      <br>
      
    </div>
    <h2>Tambah Pengguna</h2>
    <form method="post" action="">
        NIK: <input type="text" name="nik" required><br><br>
        Nama: <input type="text" name="nama" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        HP: <input type="text" name="hp" required><br><br>
        <input type="submit" name="submit" value="Tambah Pengguna">
    </form>

    <br><br>
    <h2>Daftar Pengguna</h2>
    <?php
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
    ?>

</body>
</html>

<?php
$conn->close();
?>
