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
              Data User
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-7 col-md-6 mb-4 d-flex justify-content-end align-items-end">
      <a href="../adduser/" class="btn btn-sm btn-info shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah User</a>
    </div>
  </div>


  <div class="row">
    <div class="col-xl-12 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <!-- buatkan tabel menggunakan datatables -->
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <!-- membuat head -->
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Hak Akses</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <!-- membuat body -->
              <tbody>
                <?php
                // buat looping untuk menampilkan seluruh data di database
                $query = mysqli_query($conn, "SELECT * FROM user");
                $no = 1;
                while ($data = mysqli_fetch_assoc($query)) {
                ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data['nama_lengkap']; ?></td>
                    <td><?= $data['level']; ?></td>
                    <td>
                      <a href="../changeuser/index.php?id_user=<?= $data['id_user']; ?>" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                      <a href="#" class="btn btn-sm btn-danger delete-btn" data-toggle="modal" data-target="#deleteModal<?= $data['id_user']; ?>" data-id="<?= $data['id_user']; ?>"><i class="fas fa-trash"></i></a>

                      <!-- Delete Modal-->
                      <div class="modal fade" id="deleteModal<?= $data['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Apakah Yakin Ingin Menghapus <?= $data['nama_lengkap']; ?>?</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">Data yang Anda hapus tidak dapat dikembalikan.</div>
                            <div class="modal-footer">
                              <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
                              <form action="proses_delete.php" method="post">
                                <input type="hidden" name="id_user" value="<?= $data['id_user']; ?>">
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
<?php include '../template/footer.php' ?>