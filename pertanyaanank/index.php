<?php include '../template/header.php';
include '../database/koneksi.php';
?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- judul -->
  <div class="row">
    <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="col mr-2">
            <div id="pertanyaanKategori" class="h3 font-weight-bold text-info text-uppercase mb-1">
              Data Pertanyaan Anak
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-12 mb-4 d-flex justify-content-end align-items-end">
      <div class="btn-group mx-1">
        <button class="btn btn-info btn-sm shadow-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
          Pilih Kategori
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" id="tampilDewasa" href="../pertanyaan/">Pertanyaan Dewasa</a>
          <a class="dropdown-item" id="tampilAnak" href="#">Pertanyaan Anak</a>
        </div>
      </div>
      <a href="../addpertanyaan/" class="btn btn-sm btn-info shadow-sm mx-1"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pertanyaan</a>
    </div>
  </div>


  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="table-responsive" id="tabelAnak">
            <table class="table table-bordered tabelAnak" id="dataTable" width="100%" cellspacing="0">
              <!-- membuat head -->
              <thead>
                <tr class="text-info">
                  <th>No</th>
                  <th>Kode</th>
                  <th>Gejala</th>
                  <th>Pertanyaan</th>
                  <th width="100px">Aksi</th>
                </tr>
              </thead>
              <!-- membuat body -->
              <tbody>
                <?php
                // buat looping untuk menampilkan seluruh data di database
                $queryAnk = mysqli_query($conn, "SELECT * FROM pertanyaan_ank");
                $no = 1;
                while ($dataAnk = mysqli_fetch_assoc($queryAnk)) {
                ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $dataAnk['id_pertanyaanAnk']; ?></td>
                    <td><?= $dataAnk['gejala']; ?></td>
                    <td><?= $dataAnk['pertanyaan']; ?></td>
                    <td class="text-center">
                      <a href="../changepertanyaan/index.php?id_pertanyaan=<?= $dataAnk['id_pertanyaanAnk']; ?>" class="btn btn-sm btn-info my-sm-2"><i class="fas fa-edit"></i></a>
                      <a href="#" class="btn btn-sm btn-danger delete-btn" data-toggle="modal" data-target="#deleteModal<?= $dataAnk['id_pertanyaanAnk']; ?>" data-id="<?= $dataAnk['id_pertanyaanAnk']; ?>"><i class="fas fa-trash"></i></a>

                      <!-- Delete Modal-->
                      <div class="modal fade" id="deleteModal<?= $dataAnk['id_pertanyaanAnk']; ?>" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Apakah Yakin?</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">Data yang Anda hapus tidak dapat dikembalikan.</div>
                            <div class="modal-footer">
                              <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
                              <form action="proses_delete.php" method="post">
                                <input type="hidden" name="id_pertanyaan" value="<?= $dataAnk['id_pertanyaanAnk']; ?>">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- end of buatkan tabel menggunakan datatables -->
        </div>
      </div>
    </div>
  </div>
  <!-- end of judul -->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // $(document).ready(function() {
  //   // Inisialisasi DataTable untuk tabel Dewasa saat halaman dimuat
  //   var tableDewasa = $('#tabelDewasa table').DataTable();
  //   var tableAnak = null;

  //   // Sembunyikan elemen anak dan tulisan "Anak" saat halaman dimuat
  //   $('#tabelAnak').addClass('d-none');
  //   $('#pertanyaanKategori').html('Data Pertanyaan Dewasa');

  //   $('#tampilDewasa').click(function() {
  //     $('#tabelDewasa').removeClass('d-none');
  //     $('#tabelAnak').addClass('d-none');
  //     // Hapus atribut id pada tag table di dalam tag div yang memiliki id tabelAnak
  //     $('#tabelAnak table').removeAttr('id');
  //     // Setel atribut id pada tag table di dalam tag div yang memiliki id tabelDewasa
  //     $('#tabelDewasa table').attr('id', 'dataTable');
  //     // Ubah tulisan di dalam id pertanyaanKategori menjadi Data Pertanyaan Dewasa
  //     $('#pertanyaanKategori').html('Data Pertanyaan Dewasa');

  //     // Hapus dan re-inisialisasi DataTable untuk tabel Dewasa
  //     if (tableAnak) {
  //       tableAnak.destroy();
  //       tableAnak = null;
  //     }

  //     // Hapus dan re-inisialisasi DataTable untuk tabel Dewasa
  //     if ($.fn.DataTable.isDataTable('#dataTable')) {
  //       tableDewasa.destroy();
  //     }
  //     tableDewasa = $('#dataTable').DataTable();
  //   });

  //   $('#tampilAnak').click(function() {
  //     $('#tabelAnak').removeClass('d-none');
  //     $('#tabelDewasa').addClass('d-none');
  //     // Hapus atribut id pada tag table di dalam tag div yang memiliki id tabelDewasa
  //     $('#tabelDewasa table').removeAttr('id');
  //     // Setel atribut id pada tag table di dalam tag div yang memiliki id tabelAnak
  //     $('#tabelAnak table').attr('id', 'dataTable');
  //     // Ubah tulisan di dalam id pertanyaanKategori menjadi Data Pertanyaan Anak
  //     $('#pertanyaanKategori').html('Data Pertanyaan Anak');

  //     // Hapus dan re-inisialisasi DataTable untuk tabel Anak
  //     if (tableDewasa) {
  //       tableDewasa.destroy();
  //       tableDewasa = null;
  //     }

  //     // Hapus dan re-inisialisasi DataTable untuk tabel Anak
  //     if ($.fn.DataTable.isDataTable('#dataTable')) {
  //       tableAnak.destroy();
  //     }
  //     tableAnak = $('#dataTable').DataTable();
  //   });
  // });
</script>





<?php include '../template/footer.php' ?>