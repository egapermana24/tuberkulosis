<?php 
include '../database/koneksi.php';
// delete by id
$id_penyakit = $_POST['id_penyakit'];
$query = mysqli_query($conn, "DELETE FROM penyakit WHERE id_penyakit='$id_penyakit'");
if ($query) {
  echo "<script>alert('Data berhasil dihapus!'); window.location.href='../penyakit/'</script>";
} else {
  echo "<script>alert('Data gagal dihapus'); window.location.href='../penyakit/'</script>";
}

?>