<?php 
include '../database/koneksi.php';

if (isset($_POST['id_pertanyaan'])) {
  $id_pertanyaan = $_POST['id_pertanyaan'];
  $query = mysqli_query($conn, "DELETE FROM pertanyaan WHERE id_pertanyaan='$id_pertanyaan'");
  if ($query) {
    echo "<script>alert('Data berhasil dihapus!'); window.location.href='../pertanyaan/'</script>";
  } else {
    echo "<script>alert('Data gagal dihapus'); window.location.href='../pertanyaan/'</script>";
  }
}
if (isset($_POST['id_pertanyaanAnk'])) {
  $id_pertanyaanAnk = $_POST['id_pertanyaanAnk'];
  $query = mysqli_query($conn, "DELETE FROM pertanyaan_anak WHERE id_pertanyaanAnk='$id_pertanyaanAnk'");
  if ($query) {
    echo "<script>alert('Data berhasil dihapus!'); window.location.href='../pertanyaan/'</script>";
  } else {
    echo "<script>alert('Data gagal dihapus'); window.location.href='../pertanyaan/'</script>";
  }
}
