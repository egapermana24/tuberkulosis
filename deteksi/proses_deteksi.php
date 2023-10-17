<?php
include '../database/koneksi.php';

// mengambil id penyakit dari tabel penyakit
$query = mysqli_query($conn, "SELECT id_penyakit FROM penyakit");
while ($row = mysqli_fetch_assoc($query)) {
  $id_penyakit[] = $row['id_penyakit'];
}

// mengambil id pertanyaan dan gejala dari tabel pertanyaan
$query = mysqli_query($conn, "SELECT id_pertanyaan, gejala FROM pertanyaan");
while ($row = mysqli_fetch_assoc($query)) {
  $id_pertanyaan[] = $row['id_pertanyaan'];
  $gejala[] = $row['gejala'];
}

$jawaban = $_POST['jawaban'];
$pointParu = 0;
$pointKelenjar = 0;
$pointTulang = 0;
$jenisTuberkulosis = '';

// buat array kososng untuk menampung gejala dari tiap-tiap jenis tuberkulosis
$gejalaParu = [];
$gejalaKelenjar = [];
$gejalaTulang = [];

if ($jawaban['G003'][0] == 'Ya') {
  $pointParu += 1;
  $pointKelenjar += 1;
  $pointTulang += 1;
  // ambil gejala dari variabel $gejala berdasarkan id_pertanyaan 'G003' lalu simpan ke dalam array
  $gejalaParu[] = $id_pertanyaan[2];
  $gejalaKelenjar[] = $id_pertanyaan[2];
  $gejalaTulang[] = $id_pertanyaan[2];
}

if ($jawaban['G001'][0] == 'Ya' && $jawaban['G002'][0] == 'Ya' && $jawaban['G004'][0] == 'Ya' && $jawaban['G005'][0] == 'Ya') {
  // ambil gejala dari variabel $gejala berdasarkan id_pertanyaan 'G001', 'G002', 'G004', 'G005' lalu simpan ke dalam array $gejalaParu
  $gejalaParu[] = $id_pertanyaan[0];
  $gejalaParu[] = $id_pertanyaan[1];
  $gejalaParu[] = $id_pertanyaan[3];
  $gejalaParu[] = $id_pertanyaan[4];
  $jenisTuberkulosis = 'Tuberkulosis Paru';
  $pointParu += 4;
  if ($jawaban['G006'][0] == 'Ya') {
    $gejalaParu[] = $id_pertanyaan[5];
    $pointParu += 1;
  }
  if ($jawaban['G007'][0] == 'Ya') {
    $gejalaParu[] = $id_pertanyaan[6];
    $pointParu += 1;
  }
  if ($jawaban['G006'][0] == 'Tidak') {
    $gejalaKelenjar[] = $id_pertanyaan[0];
    $gejalaKelenjar[] = $id_pertanyaan[1];
    $gejalaKelenjar[] = $id_pertanyaan[3];
    $gejalaKelenjar[] = $id_pertanyaan[4];
    $pointKelenjar += 4;
    if ($jawaban['G015'][0] == 'Ya') {
      $gejalaKelenjar[] = $id_pertanyaan[14];
      $jenisTuberkulosis = 'Tuberkulosis Kelenjar';
      $pointKelenjar += 1;
      if ($jawaban['G016'][0] == 'Ya') {
        $gejalaKelenjar[] = $id_pertanyaan[15];
        $pointKelenjar += 1;
      }
      if ($jawaban['G017'][0] == 'Ya') {
        $gejalaKelenjar[] = $id_pertanyaan[16];
        $pointKelenjar += 1;
      }
      if ($jawaban['G018'][0] == 'Ya') {
        $gejalaKelenjar[] = $id_pertanyaan[17];
        $pointKelenjar += 1;
      }
    }
    if ($jawaban['G015'][0] == 'Tidak') {
      $gejalaTulang[] = $id_pertanyaan[0];
      $gejalaTulang[] = $id_pertanyaan[1];
      $gejalaTulang[] = $id_pertanyaan[3];
      $gejalaTulang[] = $id_pertanyaan[4];
      $pointTulang += 4;
      if ($jawaban['G008'][0] == 'Ya') {
        $gejalaTulang[] = $id_pertanyaan[7];
        $jenisTuberkulosis = 'Tuberkulosis Tulang';
        $pointTulang += 1;
        if ($jawaban['G009'][0] == 'Ya') {
          $gejalaTulang[] = $id_pertanyaan[8];
          $pointTulang += 1;
        }
        if ($jawaban['G010'][0] == 'Ya') {
          $gejalaTulang[] = $id_pertanyaan[9];
          $pointTulang += 1;
        }
        if ($jawaban['G011'][0] == 'Ya') {
          $gejalaTulang[] = $id_pertanyaan[10];
          $pointTulang += 1;
        }
        if ($jawaban['G012'][0] == 'Ya') {
          $gejalaTulang[] = $id_pertanyaan[11];
          $pointTulang += 1;
        }
        if ($jawaban['G013'][0] == 'Ya') {
          $gejalaTulang[] = $id_pertanyaan[12];
          $pointTulang += 1;
        }
        if ($jawaban['G014'][0] == 'Ya') {
          $gejalaTulang[] = $id_pertanyaan[13];
          $pointTulang += 1;
        }
      }
    }
  }
} else {
  $probabilitas = 0;
  $id_penyakit = isset($id_penyakit[3]) ? $id_penyakit[3] : ''; // Pastikan $id_penyakit[3] ada dan memiliki nilai yang sesuai.
  $id_user = 'USR001';
  $id_hasil = $newCode;
  $jenisTuberkulosis = 'Tidak ada penyakit';
  $value = 'Tidak Ada Gejala';

  // Gunakan Prepared Statement untuk menghindari SQL Injection
  $insertGejala = mysqli_prepare($conn, "INSERT INTO gejalalengkap (id, id_user, value) VALUES (NULL, ?, ?)");
  $insertHasil = mysqli_prepare($conn, "INSERT INTO hasil (id_hasil, id_user, id_penyakit, probabilitas) VALUES (?, ?, ?, ?)");

  if ($insertGejala && $insertHasil) {
    mysqli_stmt_bind_param($insertGejala, "ss", $id_user, $value);
    mysqli_stmt_bind_param($insertHasil, "ssdi", $id_hasil, $id_user, $id_penyakit, $probabilitas);

    // Eksekusi query
    if (mysqli_stmt_execute($insertGejala) && mysqli_stmt_execute($insertHasil)) {
      echo "<script>window.location.href='../hasil/'</script>";
      exit;
    } else {
      echo "<script>alert('Data gagal ditambahkan'); window.location.href='index.php'</script>";
      exit;
    }
  } else {
    echo "Error in Prepared Statement.";
    exit;
  }
}

$probabilitas = 0;

// buat id_hasil otomatis, contoh : H001
$query = mysqli_query($conn, "SELECT max(id_hasil) as kodeTerbesar FROM hasil");
$data = mysqli_fetch_array($query);
$kodeHasil = $data['kodeTerbesar'];
if ($kodeHasil) {
  $urutan = (int) substr($kodeHasil, 1);
  $urutan++;
} else {
  // Jika tidak ada data sebelumnya, mulai dari 1
  $urutan = 1;
}
$newCode = 'H' . sprintf("%03d", $urutan);

// // kondisi jika semua jawaban 'Ya' maka akan memunculkan alert untuk memilih jawaban yang jujur dan benar
// if ($pointParu >= 4 && $jawaban['G015'][0] == 'Ya' && $jawaban['G008'][0] == 'Ya') {
//   echo "<script>alert('Jawablah pertanyaan dengan jujur dan benar'); window.location.href='index.php'</script>";
// }

if ($jawaban['G015'][0] == 'Ya' && $pointKelenjar > 4 && $jawaban['G006'][0] == 'Tidak') {
  $probabilitas = $pointKelenjar / 9 * 100;
  $probabilitas = number_format($probabilitas, 2);
  $id_penyakit = $id_penyakit[2];
  $id_user = 'USR001';
  $id_hasil = $newCode;
  $jenisTuberkulosis = 'Tuberkulosis Kelenjar';
  foreach ($gejalaKelenjar as $key => $value) {
    $query = mysqli_query($conn, "INSERT INTO gejalalengkap VALUES('', '$id_user', '$value')");
  }
  $query = mysqli_query($conn, "INSERT INTO hasil VALUES('$id_hasil', '$id_user', '$id_penyakit', '$probabilitas')");
  if ($query) {
    echo "<script>window.location.href='../hasil/'</script>";
    exit;
  } else {
    echo "<script>alert('Data gagal ditambahkan'); window.location.href='index.php'</script>";
    exit;
  }
}

if ($jawaban['G008'][0] == 'Ya' && $pointTulang > 4 && $jawaban['G006'][0] == 'Tidak') {
  $probabilitas = $pointTulang / 12 * 100;
  $probabilitas = number_format($probabilitas, 2);
  $id_penyakit = $id_penyakit[1];
  $id_user = 'USR001';
  $id_hasil = $newCode;
  $jenisTuberkulosis = 'Tuberkulosis Tulang';
  foreach ($gejalaTulang as $key => $value) {
    $query = mysqli_query($conn, "INSERT INTO gejalalengkap VALUES('', '$id_user', '$value')");
  }
  $query = mysqli_query($conn, "INSERT INTO hasil VALUES('$id_hasil', '$id_user', '$id_penyakit', '$probabilitas')");
  if ($query) {
    echo "<script>window.location.href='../hasil/'</script>";
    exit;
  } else {
    echo "<script>alert('Data gagal ditambahkan'); window.location.href='index.php'</script>";
    exit;
  }
}

if ($pointParu >= 4) {
  $probabilitas = $pointParu / 7 * 100;
  $probabilitas = number_format($probabilitas, 2);
  $id_penyakit = $id_penyakit[0];
  $id_user = 'USR001';
  $id_hasil = $newCode;
  $jenisTuberkulosis = 'Tuberkulosis Paru';
  // agar array $gejalaParu melakukan looping dan tiap 1 anggota array mengisi 1 row di tabel gejalalengkap
  foreach ($gejalaParu as $key => $value) {
    $query = mysqli_query($conn, "INSERT INTO gejalalengkap VALUES('', '$id_user', '$value')");
  }
  // input id_hasil, id_user, dan id_penyakit ke tabel hasil
  $query = mysqli_query($conn, "INSERT INTO hasil VALUES('$id_hasil', '$id_user', '$id_penyakit', '$probabilitas')");
  if ($query) {
    echo "<script>window.location.href='../hasil/'</script>";
    exit;
  } else {
    echo "<script>alert('Data gagal ditambahkan'); window.location.href='index.php'</script>";
    exit;
  }
}



// agar angka di variabel $probabilitas hanya memiliki 2 angka dibelakang koma

if ($probabilitas <= 0) {
  $probabilitas = 0;
  $id_penyakit = $id_penyakit[3];
  $id_user = 'USR001';
  $id_hasil = $newCode;
  $jenisTuberkulosis = 'Tidak ada penyakit';
  $value = 'Tidak Ada Gejala';
  $query = mysqli_query($conn, "INSERT INTO gejalalengkap VALUES('', '$id_user', '$value')");
  $query = mysqli_query($conn, "INSERT INTO hasil VALUES('$id_hasil', '$id_user', '$id_penyakit', '$probabilitas')");
}
