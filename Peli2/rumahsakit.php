<?php
include 'koneksi.php';
include 'navbar.php';

// Proses Tambah Rumah Sakit
if(isset($_POST['submit'])) {
    $idfaskes = $_POST['id_faskes'];
    $namafaskes = $_POST['nama_faskes']; // Ubah nama variabel menjadi sesuai dengan yang digunakan dalam form
    $alamat = $_POST['alamat'];

    // Query untuk menyimpan data rumah sakit baru
    $sql = "INSERT INTO RumahSakit (id_faskes, nama_faskes, alamat) VALUES ('$idfaskes', '$namafaskes', '$alamat')";

    if ($conn->query($sql) === TRUE) {
        echo "Data rumah sakit berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Ambil data rumah sakit dari database untuk ditampilkan
$sql = "SELECT * FROM RumahSakit";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>RumahSakit</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-image: url(images/OIP.jpg);
}
-->
</style></head>
<body>
    <h1 align="center">Rumah Sakit</h1>
    <div align="right"><a href="index.php">Kembali ke Halaman Utama</a>
        <br>
      <br>
      
    </div>
    <h2>Tambah Rumah Sakit</h2>
    <form method="post" action="">
        ID Faskes: <input type="text" name="id_faskes" required><br><br>
        Nama Faskes: <input type="text" name="nama_faskes" required><br><br>
        Alamat: <input type="text" name="alamat" required><br><br>
        <input type="submit" name="submit" value="Tambah Rumah Sakit">
    </form>

    <br><br>
    <h2>Daftar Rumah Sakit</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID Faskes</th><th>Nama Faskes</th><th>Alamat</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id_faskes']."</td>";
            echo "<td>".$row['nama_faskes']."</td>";
            echo "<td>".$row['alamat']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada data rumah sakit.";
    }
    ?>

</body>
</html>

<?php
$conn->close();
?>
