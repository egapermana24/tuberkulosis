<?php include '../template/header.php';
include '../database/koneksi.php';
// ambil data dari pertanyaan
$query = mysqli_query($conn, "SELECT * FROM pertanyaan");
// ambil data dari penyakit
$query2 = mysqli_query($conn, "SELECT * FROM penyakit");
?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- judul -->
  <div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="col mr-2">
            <div class="h3 font-weight-bold text-info text-uppercase mb-1">
              Deteksi Tuberkulosis
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-6 col-md-6 mb-4 d-flex justify-content-end align-items-end">
      <a href="#" class="btn btn-sm btn-info shadow-sm mx-1" data-toggle="modal" data-target="#deleteModal" data-id=""><i class="fas fa-redo-alt fa-sm text-white-50"></i> Cek Ulang</a>

      <a href="../hasil/" class="btn btn-sm btn-info shadow-sm mx-1"><i class="fas fa-clipboard-list fa-sm text-white-50"></i> Lihat Hasil</a>
    </div>
    <!-- Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Apakah Yakin?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Ini akan menghapus data seluruh jawaban kamu.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
            <form action="delete_all.php" method="post">
              <button type="submit" class="btn btn-danger">oke</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-10 col-md-6 mb-4">
      <form method="post" action="proses_deteksi.php">
        <div class="card border-top-info  border-bottom-info shadow h-100 py-2 bg-info 100 py-2 bottom-info">
          <div class="card-header text-info bg-white xt-white bottom-info font-weight-bold h5">
            Jawab Pertanyaan dibawah dengan jujur ya!
          </div>
          <ul class="list-group list-group-flush">
            <?php
            // buat looping untuk menampilkan data pertanyaan
            while ($pertanyaan = mysqli_fetch_assoc($query)) :
            ?>
              <li class="list-group-item">
                <div class="form-group">
                  <label for="exampleInputEmail1" class="text-info bottom-info font-weight-bold">[testing...<?= $pertanyaan['id_pertanyaan']; ?>] <?= $pertanyaan['pertanyaan']; ?></label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="jawaban[<?= $pertanyaan['id_pertanyaan']; ?>][]" value="Ya" id="ya<?= $pertanyaan['id_pertanyaan']; ?>_1" required>
                    <label class="form-check-label" for="ya<?= $pertanyaan['id_pertanyaan']; ?>_1">
                      Ya
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="jawaban[<?= $pertanyaan['id_pertanyaan']; ?>][]" value="Tidak" id="tidak<?= $pertanyaan['id_pertanyaan']; ?>_2" required>
                    <label class="form-check-label" for="tidak<?= $pertanyaan['id_pertanyaan']; ?>_2">
                      Tidak
                    </label>
                  </div>
                </div>
              </li>
            <?php endwhile; ?>
          </ul>
          <div class="col-xl-12 col-md-6 my-3 d-flex justify-content-center">
            <!-- cancel -->
            <a href="../dashboard/index.php" class="btn btn-outline-light mx-1">Cancel</a>
            <button type="submit" class="btn btn-light mx-1 text-info">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    // Aktifkan modal saat tombol "Cek Ulang" ditekan
    $('[data-toggle="modal"]').click(function() {
      var targetModal = $(this).data('target');
      $(targetModal).modal('show');
    });
  });
</script>

<script>
  // Menggunakan JavaScript untuk memastikan hanya satu pilihan yang bisa dipilih pada setiap grup
  var radios = document.querySelectorAll('input[type="radio"]');
  radios.forEach(function(radio) {
    radio.addEventListener('change', function() {
      var groupName = radio.getAttribute('name');
      radios.forEach(function(otherRadio) {
        if (otherRadio.getAttribute('name') === groupName && otherRadio !== radio) {
          otherRadio.checked = false;
        }
      });
    });
  });
</script>
<!-- End of Main Content -->
<?php include '../template/footer.php' ?>