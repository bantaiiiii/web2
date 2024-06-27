<?php
include 'koneksi.php';

// Proses Tambah Catatan Kesehatan
if (isset($_POST['submit'])) {
    $kodeVaksin = $_POST['kodevaksin'];
    $NIK = $_POST['NIK'];
    $tanggal = $_POST['tanggal'];
    $dosis = $_POST['dosis'];
    $idfaskes = $_POST['id_faskes'];

    // Hindari SQL injection
    $kodeVaksin = mysqli_real_escape_string($conn, $kodeVaksin);
    $NIK = mysqli_real_escape_string($conn, $NIK);
    $tanggal = mysqli_real_escape_string($conn, $tanggal);
    $dosis = mysqli_real_escape_string($conn, $dosis);
    $idfaskes = mysqli_real_escape_string($conn, $idfaskes);

    // Cek apakah kode vaksin ada di tabel vaksin
    $cekVaksin = "SELECT * FROM Vaksin WHERE Kode_vaksin = '$kodeVaksin'";
    $resultCekVaksin = $conn->query($cekVaksin);

    if ($resultCekVaksin->num_rows > 0) {
        // Query untuk menyimpan data catatan kesehatan baru
        $sql = "INSERT INTO CatatanKesehatan (kodevaksin, NIK, tanggal, dosis, id_faskes) VALUES ('$kodeVaksin', '$NIK', '$tanggal', '$dosis', '$idfaskes')";

        if ($conn->query($sql) === TRUE) {
            echo "Data catatan kesehatan berhasil ditambahkan.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Kode vaksin tidak ditemukan.";
    }
}

// Ambil data catatan kesehatan dari database untuk ditampilkan
$sql = "SELECT * FROM CatatanKesehatan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Catatan Kesehatan</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-image: url(images/OIP.jpg);
}
-->
</style></head>
<body>
    <h1 align="center">Catatan Kesehatan</h1>
    <div align="right"><a href="navbar.php">Kembali ke Halaman Utama</a>
        <br>
      <br>
      
    </div>
    <h2 align="center">Tambah Catatan Kesehatan</h2>
    <form method="post" action="">
      <p>
        Kode Vaksin: 
        <input type="text" name="kodevaksin" required>
        <br>
        <br>
        NIK:     
        <input type="text" name="NIK" required>
        <br>
        <br>
        Tanggal: 
        <input type="date" name="tanggal" required>
        <br>
        <br>
        Dosis: 
        <input type="text" name="dosis" required>
        <br>
        <br>
        ID Faskes: 
        <input type="text" name="id_faskes" required>
        <br>
        <br>
        <input type="submit" name="submit" value="Tambah Catatan Kesehatan">
      </p>
</form>

    <br><br>
    <h2>Daftar Catatan Kesehatan</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Kode Vaksin</th><th>NIK</th><th>Tanggal</th><th>Dosis</th><th>ID Faskes</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['kodevaksin']."</td>"; // Pastikan nama kolom ini benar sesuai dengan database Anda
            echo "<td>".$row['NIK']."</td>";
            echo "<td>".$row['tanggal']."</td>";
            echo "<td>".$row['dosis']."</td>";
            echo "<td>".$row['id_faskes']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada data catatan kesehatan.";
    }
    ?>

</body>
</html>

<?php
$conn->close();
?>
