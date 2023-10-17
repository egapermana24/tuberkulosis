<?php
include '../database/koneksi.php';
$id_penyakit = $_POST['id_penyakit'];
$penyakit = $_POST['penyakit'];
$penjelasan = $_POST['penjelasan'];
$waktu = date('Y-m-d H:i:s');

// bersihkan menggunakan htmlspecialchars
$penyakit = htmlspecialchars($penyakit);
$penjelasan = htmlspecialchars($penjelasan);
// tambah ke database
$query = mysqli_query($conn, "INSERT INTO penyakit VALUES ('$id_penyakit', '$penyakit', '$penjelasan', '$waktu')");
if ($query) {
  echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='../penyakit/'</script>";
} else {
  echo "<script>alert('Data gagal ditambahkan'); window.location.href='index.php'</script>";
}
