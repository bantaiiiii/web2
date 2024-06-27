<?php
include 'koneksi.php';


// Proses Tambah Catatan Kesehatan
if(isset($_POST['submit'])) {
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
        $sql = "INSERT INTO CatatanKesehatan (Kodevaksin, NIK, tanggal, dosis, id_faskes) VALUES ('$kodeVaksin', '$NIK', '$tanggal', '$dosis', '$idfaskes')";

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
