<?php 
include '../database/koneksi.php';
// hapus semua data di tabel gejalalengkap dan tabel hasil berdasarkan USR001
$query = mysqli_query($conn, "DELETE FROM gejalalengkap WHERE id_user='USR001'");
$query2 = mysqli_query($conn, "DELETE FROM hasil WHERE id_user='USR001'");
if ($query && $query2) {
  echo "<script> window.location.href='../deteksi/'</script>";
} else {
  echo "<script>alert('Data gagal dihapus'); window.location.href='../deteksi/'</script>";
}


?>