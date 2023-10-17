<?php
include "../database/koneksi.php";

$aksi = $_GET['aksi'];
if ($aksi == "login") {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
  if (mysqli_num_rows($query) == 0) {
    echo "<script language='JavaScript'>
    alert('Username atau Password Anda Salah!');
    window.location.href='index.php';
    </script>";
  }
  $row = mysqli_fetch_array($query);
  $namaLengkap = $row['nama_lengkap'];
  $id_user = $row['id_user'];
  $level = $row['level'];
  $tempat = $row['tempat'];
  $tgl_lahir = $row['tgl_lahir'];
  $alamat = $row['alamat'];
  $jenis_kelamin = $row['jenis_kelamin'];
  $nohp = $row['nohp'];

  $hashedPassword = $row['password']; // Password di-hash yang ada di database

  if (password_verify($password, $hashedPassword)) {
    $cek = mysqli_num_rows($query);
    if ($cek > 0) {
      session_start();
      $_SESSION['id_user'] = $id_user;
      $_SESSION['username'] = $username;
      $_SESSION['nama_lengkap'] = $namaLengkap;
      $_SESSION['level'] = $level;
      $_SESSION['tempat'] = $tempat;
      $_SESSION['tgl_lahir'] = $tgl_lahir;
      $_SESSION['alamat'] = $alamat;
      $_SESSION['jenis_kelamin'] = $jenis_kelamin;
      $_SESSION['nohp'] = $nohp;
      // redirect tanpa alert
      header("Location: ../dashboard/");
    } else {
      echo "<script language='JavaScript'>
      alert('Username atau Password Anda Salah!');
      window.location.href='index.php';
      </script>";
    }
  } else {
    echo "<script language='JavaScript'>
    alert('Username atau Password Anda Salah!');
    window.location.href='index.php';
    </script>";
  }
} else if ($aksi == "logout") {
  session_start();
  $_SESSION['username'] = "";
  session_unset();
  session_destroy();
  // redirect tanpa alert
  header("Location: ../login/");
} else {
  echo "<script language='JavaScript'>
    alert('Anda Tidak Memiliki Akses!');
    window.location.href='../login/';
    </script>";
}
