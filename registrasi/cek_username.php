<?php
// Sambungkan ke database (ganti dengan koneksi database yang sesuai)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'tuberkulosis';

$koneksi = new mysqli($host, $username, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil data username dari permintaan POST
if (isset($_POST['username'])) {
    $username = $koneksi->real_escape_string($_POST['username']);

    // Periksa apakah username sudah digunakan
    $query = "SELECT COUNT(*) as count FROM user WHERE username = '$username'";
    $result = $koneksi->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        $count = $row['count'];

        // Kirim respons berdasarkan hasil pemeriksaan
        if ($count > 0) {
            echo "0"; // Username sudah digunakan
        } else {
            echo "1"; // Username tersedia
        }
    } else {
        echo "0"; // Terjadi kesalahan dalam pengambilan data
    }
} else {
    echo "0"; // Permintaan tidak valid
}

$koneksi->close();
?>
