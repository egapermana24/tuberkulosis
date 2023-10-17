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
              Tambah Pertanyaan
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-7 col-md-6 mb-4 d-flex justify-content-end align-items-start">
      <a href="../pertanyaan/" class="btn btn-sm btn-info shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
    </div>
  </div>


  <div class="row">
    <div class="col-xl-12 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <form method="post" action="proses_add.php">
            <?php
            // buat kode otomatis
            $query = mysqli_query($conn, "SELECT max(id_pertanyaan) as kodeTerbesar FROM pertanyaan");
            $data = mysqli_fetch_array($query);
            $kodePertanyaan = $data['kodeTerbesar'];
            if ($kodePertanyaan) {
              $urutan = (int) substr($kodePertanyaan, 1);
              $urutan++;
            } else {
              // Jika tidak ada data sebelumnya, mulai dari 1
              $urutan = 1;
            }
            $newCode = 'G' . sprintf("%03d", $urutan);

            $queryAnk = mysqli_query($conn, "SELECT max(id_pertanyaanAnk) as kodeTerbesar FROM pertanyaan_ank");
            $dataAnk = mysqli_fetch_array($queryAnk);
            $kodePertanyaanAnk = $dataAnk['kodeTerbesar'];
            if ($kodePertanyaanAnk) {
              $urutanAnk = (int) substr($kodePertanyaanAnk, 1);
              $urutanAnk++;
            } else {
              // Jika tidak ada data sebelumnya, mulai dari 1
              $urutanAnk = 1;
            }
            $newCodeAnk = 'G' . sprintf("%03d", $urutanAnk);
            ?>

            <div class="form-group">
              <label for="kategori" class="text-info font-weight-bold">Pertanyaan Untuk Anak-anak atau Dewasa</label>
              <select type="text" class="form-control" id="kategori" name="kategori" required>
                <option value="" selected hidden disabled>Pilih Kategori Usia</option>
                <option value="anak">Anak-anak</option>
                <option value="dewasa">Dewasa</option>
              </select>
            </div>

            <div id="dewasa" class="d-none">
              <!-- Ganti ID elemen dengan yang unik untuk dewasa -->
              <div class="form-group">
                <label for="kodeDewasa" class="text-info font-weight-bold">Kode</label>
                <input type="text" class="form-control" id="kodeDewasa" name="id_pertanyaan" value="<?= $newCode; ?>" readonly required>
              </div>
              <!-- Ganti ID elemen dengan yang unik untuk dewasa -->
              <div class="form-group">
                <label for="gejalaDewasa" class="text-info font-weight-bold">Gejala</label>
                <input type="text" class="form-control" name="gejalaDewasa" id="gejalaDewasa" placeholder="Masukkan Gejala" autofocus>
              </div>
              <!-- Ganti ID elemen dengan yang unik untuk dewasa -->
              <div class="form-group">
                <label for="pertanyaanDewasa" class="text-info font-weight-bold">Pertanyaan</label>
                <input type="text" class="form-control" name="pertanyaanDewasa" id="pertanyaanDewasa" placeholder="Masukkan Pertanyaan">
              </div>
            </div>

            <div id="anak" class="d-none">
              <!-- Ganti ID elemen dengan yang unik untuk anak -->
              <div class="form-group">
                <label for="kodeAnak" class="text-info font-weight-bold">Kode</label>
                <input type="text" class="form-control" id="kodeAnak" name="id_pertanyaanAnk" value="<?= $newCodeAnk; ?>" readonly required>
              </div>
              <!-- Ganti ID elemen dengan yang unik untuk anak -->
              <div class="form-group">
                <label for="gejalaAnak" class="text-info font-weight-bold">Gejala</label>
                <input type="text" class="form-control" name="gejalaAnak" id="gejalaAnak" placeholder="Masukkan Gejala" autofocus>
              </div>
              <!-- Ganti ID elemen dengan yang unik untuk anak -->
              <div class="form-group">
                <label for="pertanyaanAnak" class="text-info font-weight-bold">Pertanyaan</label>
                <input type="text" class="form-control" name="pertanyaanAnak" id="pertanyaanAnak" placeholder="Masukkan Pertanyaan">
              </div>
            </div>
            <div id="tombol" class="col-xl-12 col-md-6 my-3 d-none justify-content-center">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Fungsi untuk menangani perubahan dalam elemen select dengan id "kategori"
    $('#kategori').change(function() {
      var selectedValue = $(this).val();

      // Jika kategori yang dipilih adalah "anak"
      if (selectedValue === "anak") {
        // tambahkan required pada inputan anak
        $('#gejalaAnak').attr('required', 'required');
        $('#pertanyaanAnak').attr('required', 'required');
        // Tampilkan elemen dengan id "anak" dan sembunyikan elemen dengan id "dewasa"
        $('#anak').removeClass('d-none');
        $('#dewasa').addClass('d-none');
        $('#tombol').removeClass('d-none')
        $('#tombol').addClass('d-flex')
        // hapus required pada inputan dewasa
        $('#gejalaDewasa').removeAttr('required');
        $('#pertanyaanDewasa').removeAttr('required');
      }
      // Jika kategori yang dipilih adalah "dewasa"
      else if (selectedValue === "dewasa") {
        // tambahkan required pada inputan dewasa
        $('#gejalaDewasa').attr('required', 'required');
        $('#pertanyaanDewasa').attr('required', 'required');
        // Tampilkan elemen dengan id "dewasa" dan sembunyikan elemen dengan id "anak"
        $('#dewasa').removeClass('d-none');
        $('#anak').addClass('d-none');
        $('#tombol').removeClass('d-none')
        $('#tombol').addClass('d-flex')
        // hapus required pada inputan anak
        $('#gejalaAnak').removeAttr('required');
        $('#pertanyaanAnak').removeAttr('required');
      }
    });
  });
</script>



<?php include '../template/footer.php' ?>