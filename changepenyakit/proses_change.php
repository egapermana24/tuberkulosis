<?php
// buatkan proses untuk mengubah data
include '../database/koneksi.php';
$id_penyakit = $_POST['id_penyakit'];
$penyakit = $_POST['penyakit'];
$penjelasan = $_POST['penjelasan'];
// bersihkan menggunakan htmlspecialchars
$penyakit = htmlspecialchars($penyakit);
$penjelasan = htmlspecialchars($penjelasan);
$query = mysqli_query($conn, "UPDATE penyakit SET penyakit='$penyakit', penjelasan='$penjelasan' WHERE id_penyakit='$id_penyakit'");
if ($query) {
  echo "<script>alert('Data berhasil diubah!'); window.location.href='../penyakit/'</script>";
} else {
  echo "<script>alert('Data gagal diubah'); window.location.href='../penyakit/'</script>";
}
