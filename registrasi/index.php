<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        /* style untuk select option jenis kelamin */
        .form-control-select {
            font-size: .8rem;
            border-radius: 10rem;
            padding-left: 1rem;
            padding-right: 1rem;
            height: 3rem;
        }

        ;
    </style>

</head>

<body class="bg-gradient-info">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image "></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Ayo mengisi data diri!</h1>
                            </div>
                            <form class="user" action="proses_registrasi.php" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="nama_lengkap" placeholder="Nama Lengkap" name="nama_lengkap" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control custom-select form-control-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="" selected disabled hidden>Jenis Kelamin</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="tempat" placeholder="Tempat Lahir" name="tempat" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="tgl_lahir" name="tgl_lahir" onfocus="this.type='date'" onblur="this.type='text'" placeholder="Tanggal Lahir" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="username" placeholder="Username" name="username" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="nohp" placeholder="Nomor Whatsapp" name="nohp" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="password" placeholder="Password" name="password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="repeatPassword" placeholder="Ulangi Password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea type="text" class="form-control form-control-user" id="alamat" placeholder="Alamat" name="alamat" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-info btn-user btn-block" id="submit">
                                    Daftar Sekarang
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="../login/">Sudah punya akun? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#submit').attr('disabled', true);

            // buat validasi untuk username yaitu, tidak boleh sama dengan yang ada di database, huruf kecil semua, tidak boleh ada spasi, dan minimal 3 karakter
            $('#username').keyup(function() {
                var username = $('#username').val();
                // validasi untuk spasi 
                if (username.indexOf(' ') >= 0) {
                    $('#username').next('.text-danger').remove();
                    $('#username').after('<small class="text-danger">Username tidak boleh ada spasi</small>');
                    $('#username').addClass('is-invalid');
                    $('#submit').attr('disabled', true);
                    die;
                } else {
                    $('#username').next('.text-danger').remove();
                    $('#username').removeClass('is-invalid');
                    if ($('#password').val() === $('#repeatPassword').val() && $('#password').val() != '' && $('#repeatPassword').val() != '' && $('#username').val() != '') {
                        $('#submit').attr('disabled', false);
                    }
                }

                $('#username').blur(function() {
                    if ($('#username').val() == '') {
                        $('#submit').attr('disabled', true);
                    }
                });

                $.ajax({
                    url: 'cek_username.php',
                    method: 'POST',
                    data: {
                        username: username
                    },
                    success: function(data) {
                        if (data == 0) {
                            $('#username').next('.text-danger').remove();
                            $('#username').after('<small class="text-danger">Username sudah digunakan</small>');
                            $('#username').addClass('is-invalid');
                            $('#submit').attr('disabled', true);
                        } else {
                            $('#username').next('.text-danger').remove();
                            $('#username').removeClass('is-invalid');
                            // jika password sudah sama dengan repeat password, maka aktifkan tombol submit
                            if ($('#password').val() === $('#repeatPassword').val() && $('#password').val() != '' && $('#repeatPassword').val() != '' && $('#username').val() != '') {
                                $('#submit').attr('disabled', false);
                            }
                        }
                    }
                });
            });

            $('#password').blur(function() {
                if ($('#password').val() == '' || $('#password').val() != $('#repeatPassword').val()) {
                    $('#submit').attr('disabled', true);
                }
            });

            $('#repeatPassword').focus(function() {
                if ($(this).val() === $('#password').val()) {
                    // Reset pesan kesalahan dan aktifkan tombol submit
                    $('#repeatPassword').next('.text-danger').remove();
                    if ($('#username').val() != '') {
                        $('#submit').attr('disabled', false);
                    }
                    // $('#submit').attr('disabled', false);
                } else {
                    // Nonaktifkan tombol submit dan tampilkan pesan kesalahan
                    $('#submit').attr('disabled', true);
                    $('#repeatPassword').next('.text-danger').remove();
                    $('#repeatPassword').after('<small class="text-danger">Password tidak sama</small>');
                    // tambahkan class is-invalid pada input repeat password
                    $('#repeatPassword').addClass('is-invalid');
                }
            });

            $('#repeatPassword').keyup(function() {
                if ($(this).val() === $('#password').val()) {
                    // Reset pesan kesalahan dan aktifkan tombol submit
                    $('#repeatPassword').next('.text-danger').remove();
                    if ($('#username').val() != '') {
                        $('#submit').attr('disabled', false);
                    }
                    // $('#submit').attr('disabled', false);
                    $('#repeatPassword').removeClass('is-invalid');
                    $('#repeatPassword').addClass('is-valid');
                } else {
                    // Nonaktifkan tombol submit dan tampilkan pesan kesalahan
                    $('#submit').attr('disabled', true);
                    $('#repeatPassword').next('.text-danger').remove();
                    $('#repeatPassword').after('<small class="text-danger">Password tidak sama</small>');
                    $('#repeatPassword').addClass('is-invalid');
                }
            });

            $('#repeatPassword').blur(function() {
                $('#repeatPassword').removeClass('is-valid');
                if ($('#username').val() == '') {
                    $('#submit').attr('disabled', true);
                }
            });
        });
    </script>


</body>

</html>