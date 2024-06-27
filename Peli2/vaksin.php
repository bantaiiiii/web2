<?php
include 'koneksi.php';
include 'navbar.php';

// Proses Tambah Vaksin
if(isset($_POST['submit'])) {
    $Kode_vaksin = $_POST['Kode_vaksin'];
    $Nama_vaksin = $_POST['Nama_vaksin'];
    $dosis = $_POST['dosis'];

    // Query untuk menyimpan data vaksin baru
    $sql = "INSERT INTO Vaksin (Kode_vaksin, Nama_vaksin, dosis) VALUES ('$Kode_vaksin', '$Nama_vaksin', '$dosis')";

    if ($conn->query($sql) === TRUE) {
        echo "Data vaksin berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Ambil data vaksin dari database untuk ditampilkan
$sql = "SELECT * FROM Vaksin";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vaksin</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-image: url(images/OIP.jpg);
}
-->
</style></head>
<body>
    <h1 align="center">Kelola Vaksin</h1>
    <div align="right"><a href="navbar.php">Kembali ke Halaman Utama</a>
        <br>
      <br>
      
    </div>
    <h2>Tambah Vaksin</h2>
    <form method="post" action="">
        Kode Vaksin: <input type="text" name="Kode_vaksin" required><br><br>
        Nama Vaksin: <input type="text" name="Nama_vaksin" required><br><br>
        Dosis: <input type="text" name="dosis" required><br><br>
        <input type="submit" name="submit" value="Tambah Vaksin">
    </form>

    <br><br>
    <h2>Daftar Vaksin</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Kode_vaksin</th><th>Nama_vaksin</th><th>dosis</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['Kode_vaksin']."</td>";
            echo "<td>".$row['Nama_vaksin']."</td>";
            echo "<td>".$row['dosis']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada data vaksin.";
    }
    ?>

</body>
</html>

<?php
$conn->close();
?>
