<?php
include 'database/connection.php';

// Validasi dan bersihkan input
$id_dataset = isset($_POST['id']) ? mysqli_real_escape_string($connection, $_POST['id']) : null;
$alpha = isset($_POST['alpha']) && is_numeric($_POST['alpha']) ? floatval($_POST['alpha']) : 0.1;

// Handling nilai alpha yang tidak sesuai
$alpha = ($alpha <= 0 || $alpha >= 1) ? 0.1 : $alpha;

// Query menggunakan prepared statement
$query = "SELECT * FROM dataset WHERE id_dataset=?";
$stmt = mysqli_prepare($connection, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $id_dataset);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_array($result);

    if ($data) {
        $nama_data = $data['nama_dataset_baru'];

        // Handling kesalahan pembacaan file
        error_reporting(E_ERROR | E_PARSE);
        include '../assets/spreadsheet-reader/SpreadsheetReader.php';
        $reader = new SpreadsheetReader("../dataset/" . $nama_data);
    } else {
        echo "Dataset tidak ditemukan.";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error dalam persiapan statement.";
}

// Tutup koneksi setelah digunakan
mysqli_close($connection);
?>
