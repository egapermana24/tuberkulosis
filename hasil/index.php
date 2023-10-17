<?php include '../template/header.php';
include '../database/koneksi.php';

// Query SQL untuk mengambil data dari tabel "hasil" yang dihubungkan dengan tabel "penyakit"
// $query = "SELECT hasil.*, penyakit.penyakit FROM hasil
//         INNER JOIN penyakit ON hasil.id_penyakit = penyakit.id_penyakit";
$query = "SELECT hasil.*, penyakit.penyakit, penyakit.penjelasan
FROM hasil
INNER JOIN penyakit ON hasil.id_penyakit = penyakit.id_penyakit;
";

$query2 = "SELECT hasil.*, pertanyaan.gejala 
FROM hasil
INNER JOIN gejalalengkap ON hasil.id_user = gejalalengkap.id_user
INNER JOIN pertanyaan ON gejalalengkap.id_pertanyaan = pertanyaan.id_pertanyaan;  
";

// Eksekusi query
$result = mysqli_query($conn, $query);
$result2 = mysqli_query($conn, $query2);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
        <a href="../deteksi/" class="d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
      </div>
    </div>
  </div>
  <!-- judul -->
  <div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 mb-4">
      <div class="col-xl-12 col-lg-12 col-md-12 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="h3 font-weight-bold text-info text-uppercase mb-1">
                  Hasil Deteksi</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 mb-4">
    </div>
  </div>
  <!-- end of judul -->
  <div class="row">
    <?php
    // Loop melalui hasil query
    while ($data = mysqli_fetch_assoc($result)) {
    ?>
      <div class="col-xl-6 col-lg-6 col-md-6 mb-4">
        <div class="col-xl-12 col-lg-12 col-md-12 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xm font-weight-bold text-info text-uppercase mb-1"><?= $data['penyakit']; ?>
                  </div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $data['probabilitas']; ?>%</div>
                    </div>
                    <div class="col">
                      <div class="progress progress-sm mr-2">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?= $data['probabilitas']; ?>%" aria-valuenow="<?= $data['probabilitas']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <?php
                  if ($data['probabilitas'] > 0) :
                  ?>
                    <div class="text-xm font-weight-bold text-info text-uppercase mb-3">Gejala yang anda alami adalah :
                    </div>
                  <?php
                  endif;
                  ?>

                  <ol class="text-xm text-info mb-3">
                    <?php
                    while ($data2 = mysqli_fetch_assoc($result2)) {
                    ?>
                      <li><?= $data2['gejala']; ?></li>
                    <?php
                    }
                    ?>
                  </ol>
                  <?php
                  if ($data['probabilitas'] > 0) :
                  ?>
                    <p class="text-xm font-weight-bold text-info mb-1">Dari gejala-gejala yang Anda pilih, Hasil diagnosa anda adalah <mark><?= $data['penyakit']; ?> <?= $data['probabilitas']; ?>%</mark>. Segera periksakan diri ke dokter untuk mendapatkan penanganan lebih lanjut.</p>
                  <?php
                  else :
                  ?>
                    <p class="text-xm font-weight-bold text-info mb-1">Dari gejala-gejala yang Anda pilih, Hasil diagnosa anda adalah <mark><?= $data['penyakit']; ?> <?= $data['probabilitas']; ?>%</mark>. Tetap jaga kesehatan dan periksa diri anda ke dokter jika di kemudian hari terdapat keluhan.</p>
                  <?php
                  endif;
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-md-6 mb-4">
        <div class="col">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <?php
                  if ($data['probabilitas'] > 0) :
                  ?>
                    <div class="h2 font-weight-bold text-info text-uppercase mb-3">Apa itu <?= $data['penyakit']; ?>?
                    </div>
                  <?php
                  endif;
                  ?>
                  <div class="text-center">
                    <img class="card-img w-75" src="../assets/img/telling.jpg" alt="">
                  </div>
                  <?php
                  if ($data['probabilitas'] > 0) :
                  ?>
                    <p class="h6 text-info mb-1 mt-3"><?= $data['penjelasan']; ?></p>
                  <?php
                  endif;
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
<?php
    }
?>
</div>
<!-- /.container-fluid -->
<?php include '../template/footer.php' ?>