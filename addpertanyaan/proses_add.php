<?php
include '../database/koneksi.php';
if (isset($_POST['kategori'])) {
  $kategori = $_POST['kategori'];
} else {
  $kategori = '';
}

if ($kategori == 'dewasa') {
  $kategori = $_POST['kategori'];
  $id_pertanyaan = $_POST['id_pertanyaan'];
  $id_penyakit = 'P001'; // id_penyakit 'P001' untuk 'Tuberkulosis
  $pertanyaan = $_POST['pertanyaanDewasa'];
  $gejala = $_POST['gejalaDewasa'];
  $waktu = date('Y-m-d H:i:s');

  // bersihkan menggunakan htmlspecialchars
  $pertanyaan = htmlspecialchars($pertanyaan);
  $gejala = htmlspecialchars($gejala);


  $query = mysqli_query($conn, "INSERT INTO pertanyaan VALUES ('$id_pertanyaan', '$id_penyakit','$pertanyaan','$gejala', '$waktu')");
  if ($query) {
    echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='../pertanyaan/'</script>";
  } else {
    echo "<script>alert('Data gagal ditambahkan'); window.location.href='index.php'</script>";
  }
} else if ($kategori == 'anak') {
  $kategori = $_POST['kategori'];
  $id_pertanyaanAnk = $_POST['id_pertanyaanAnk'];
  $id_penyakit = 'P001'; // id_penyakit 'P001' untuk 'Tuberkulosis
  $pertanyaan = $_POST['pertanyaanAnak'];
  $gejala = $_POST['gejalaAnak'];
  $waktu = date('Y-m-d H:i:s');

  // bersihkan menggunakan htmlspecialchars
  $pertanyaan = htmlspecialchars($pertanyaan);
  $gejala = htmlspecialchars($gejala);

  $query = mysqli_query($conn, "INSERT INTO pertanyaan_ank VALUES ('$id_pertanyaanAnk', '$id_penyakit','$pertanyaan','$gejala', '$waktu')");
  if ($query) {
    echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='../pertanyaan/'</script>";
  } else {
    echo "<script>alert('Data gagal ditambahkan'); window.location.href='index.php'</script>";
  }
} else {
  echo "<script>alert('Data gagal ditambahkan'); window.location.href='index.php'</script>";
}

