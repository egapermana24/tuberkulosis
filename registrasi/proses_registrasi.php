<?php
include '../database/koneksi.php';

// id_user otomatis, contohnya USR0001
$query = "SELECT MAX(id_user) as idTerbesar FROM user";
$hasil = mysqli_query($conn, $query);
$data = mysqli_fetch_array($hasil);
$id_user = $data['idTerbesar'];
$urutan = (int) substr($id_user, 3, 4);
$urutan++;
$huruf = "USR";
$id_user = $huruf . sprintf("%04s", $urutan);

$nama_lengkap = $_POST['nama_lengkap'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = 'user';
$tempat = $_POST['tempat'];
$tgl_lahir = $_POST['tgl_lahir'];
$birthDate = $tgl_lahir;
$birthDate = explode("-", $birthDate);
$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md")
  ? ((date("Y") - $birthDate[0]) - 1)
  : (date("Y") - $birthDate[0]));
$alamat = $_POST['alamat'];
$umur = $age;
$jenis_kelamin = $_POST['jenis_kelamin'];
$nohp = $_POST['nohp'];

// enkripsi password dengan md5
$password = password_hash($password, PASSWORD_DEFAULT);

// bersihkan data
$nama_lengkap = mysqli_real_escape_string($conn, $nama_lengkap);
$tempat = mysqli_real_escape_string($conn, $tempat);
$alamat = mysqli_real_escape_string($conn, $alamat);
$nohp = mysqli_real_escape_string($conn, $nohp);

$username = strtolower($username);
// cek apakah username sudah ada atau belum
$cek = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
if (mysqli_num_rows($cek) == 0) {
  $sql = mysqli_query($conn, "INSERT INTO user (id_user, nama_lengkap, username, password, level, tempat, tgl_lahir, alamat, jenis_kelamin, nohp) VALUES ('$id_user', '$nama_lengkap', '$username', '$password', '$level', '$tempat', '$tgl_lahir', '$alamat', '$jenis_kelamin', '$nohp')") or die(mysqli_error($conn));
  if ($sql) {
    echo '<script>alert("Silahkan Login"); document.location="../login/";</script>';
  } else {
    echo '<script>alert("Gagal melakukan proses registrasi"); document.location="index.php";</script>';
  }
} else {
  echo '<script>alert("Gagal, Username sudah terdaftar"); document.location="index.php";</script>';
}
