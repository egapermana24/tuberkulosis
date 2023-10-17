<?php include '../template/header.php';
include '../database/koneksi.php';
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
              Tambah User
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-7 col-md-6 mb-4 d-flex justify-content-end align-items-start">
      <a href="../user/" class="btn btn-sm btn-info shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
    </div>
  </div>


  <div class="row">
    <div class="col-xl-12 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <form method="post" action="proses_add.php">
            <div class="form-group">
              <div class="form-group">
                <label for="level" class="text-info font-weight-bold">Hak Akses</label>
                <select type="text" class="form-control" id="level" name="level" required>
                  <option value="" selected hidden disabled>Pilih Hak Akses</option>
                  <option value="user">User</option>
                  <option value="admin">Admin</option>
                </select>
              </div>
              <div class="form-group">
                <label for="kode" class="text-info font-weight-bold">Kode</label>
                <input type="text" class="form-control" id="kode" name="id_pertanyaan" value="" readonly required>
                <input type="text" class="form-control" id="kode" name="id_pertanyaanAnk" value="" readonly required>
              </div>
              <div class="form-group">
                <label for="gejala" class="text-info font-weight-bold">Gejala</label>
                <input type="text" class="form-control" name="gejala" id="gejala" placeholder="Masukkan Gejala" autofocus required>
              </div>
              <div class="form-group">
                <label for="pertanyaan" class="text-info font-weight-bold">Pertanyaan</label>
                <input type="text" class="form-control" name="pertanyaan" id="pertanyaan" placeholder="Masukkan Pertanyaan" required>
              </div>
              <div class="col-xl-12 col-md-6 my-3 d-flex justify-content-center">
                <!-- cancel -->
                <button type="reset" class="btn btn-outline-info mx-1">Reset</button>
                <button type="submit" class="btn btn-info mx-1">Tambah</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include '../template/footer.php' ?>