<?php include '../template/header.php' ?>
<?php
include '../database/koneksi.php';
// terima id untuk menampilkan data yang akan diubah
$id_penyakit = $_GET['id_penyakit'];
$query = mysqli_query($conn, "SELECT * FROM penyakit WHERE id_penyakit='$id_penyakit'");
$data = mysqli_fetch_assoc($query);

?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- judul -->
  <div class="row">
    <div class="col-xl-5 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="col mr-2">
            <div class="h3 font-weight-bold text-info text-uppercase mb-1">
              Ubah Penyakit
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-7 col-md-6 mb-4 d-flex justify-content-end align-items-start">
      <a href="../penyakit/" class="btn btn-sm btn-info shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
    </div>
  </div>


  <div class="row">
    <div class="col-xl-12 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <form method="post" action="proses_change.php">
            <div class="form-group">
              <label for="kode" class="text-info font-weight-bold">Kode</label>
              <input type="text" class="form-control" id="kode" name="id_penyakit" placeholder="Masukkan Kode" value="<?= $data['id_penyakit']; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="penyakit" class="text-info font-weight-bold">Penyakit</label>
              <input type="text" class="form-control" name="penyakit" id="penyakit" placeholder="Masukkan Penyakit" value="<?= $data['penyakit']; ?>" required>
            </div>
            <div class="form-group">
              <label for="penjelasan" class="text-info font-weight-bold">Penjelasan</label>
              <textarea class="form-control" name="penjelasan" id="penjelasan" rows="3" placeholder="Masukkan Penjelasan" value="<?= $data['penjelasan']; ?>" required><?= $data['penjelasan']; ?></textarea>
            </div>
            <div class="col-xl-12 col-md-6 my-3 d-flex justify-content-center">
              <!-- cancel -->
              <button type="reset" class="btn btn-outline-info mx-1">Reset</button>
              <button type="submit" class="btn btn-info mx-1">Ubah</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include '../template/footer.php' ?>