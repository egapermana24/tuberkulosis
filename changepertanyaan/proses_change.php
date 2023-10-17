<?php
// buatkan proses untuk mengubah data
include '../database/koneksi.php';
$id_pertanyaan = $_POST['id_pertanyaan'];
$gejala = $_POST['gejala'];
$pertanyaan = $_POST['pertanyaan'];
// bersihkan menggunakan htmlspecialchars
$pertanyaan = htmlspecialchars($pertanyaan);
$gejala = htmlspecialchars($gejala);

$query = mysqli_query($conn, "UPDATE pertanyaan SET gejala='$gejala', pertanyaan='$pertanyaan' WHERE id_pertanyaan='$id_pertanyaan'");
if ($query) {
  echo "<script>alert('Data berhasil diubah!'); window.location.href='../pertanyaan/'</script>";
} else {
  echo "<script>alert('Data gagal diubah'); window.location.href='../pertanyaan/'</script>";
}
