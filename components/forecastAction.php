<?php
include 'database/connection.php';

// Validasi dan bersihkan input
$id_dataset = isset($_POST['id']) ? mysqli_real_escape_string($connection, $_POST['id']) : null;
$alpha = isset($_POST['alpha']) && is_numeric($_POST['alpha']) ? floatval($_POST['alpha']) : 0.1;


// Handling nilai alpha  yang tidak sesuai
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


// Fungsi perhitungan double exponential smoothing
// function doubleExponentialSmoothing($data, $alpha) {
//     $n = count($data);
//     $Y = $data;

//     // Inisialisasi Y' dan Y''
//     $Y_prime = $Y[0];
//     $Y_double_prime = $Y[1] - $Y[0];

//     // Inisialisasi a dan b
//     $a = $Y_prime;
//     $b = $Y_double_prime;

//     // Inisialisasi hasil forecast
//     $forecast = [$Y_prime];

//     Perhitungan Double Exponential Smoothing
//     for ($t = 1; $t < $n; $t++) {
//         // Perhitungan Y'
//         $Y_prime_new = $alpha * $Y[$t] + (1 - $alpha) * ($a + $b);

//         // Perhitungan Y''
//         $Y_double_prime_new = $alpha * ($Y_prime_new - $Y_prime) + (1 - $alpha) * $Y_double_prime;

//         // Perhitungan a dan b
//         $a = $Y_prime_new;
//         $b = $Y_double_prime_new;

//         // Perhitungan Forecast
//         $forecast[] = $a + $b;
        
//         // Update Y' dan Y''
//         $Y_prime = $Y_prime_new;
//         $Y_double_prime = $Y_double_prime_new;
//     }
//         // if ($t == 0 ) {
//         //     $forecast = 0 ;
//         // }
        
//         return $forecast;
//     }


// Fungsi perhitungan single exponential smoothing
function singleExponentialSmoothing($data, $alpha) {
    $n = count($data);
    $Y = $data;

    // Inisialisasi Y'
    $Y_prime = $Y[0];

    // Inisialisasi hasil forecast
    $forecast = [$Y_prime];

    // Perhitungan Single Exponential Smoothing dimulai dari baris kedua
    for ($t = 1; $t < $n; $t++) {
        // Perhitungan Y'
        $Y_prime_new = $alpha * $Y[$t - 1] + (1 - $alpha) * $Y_prime;

        // Perhitungan Forecast
        $forecast[] = $Y_prime_new;

        // Update Y'
        $Y_prime = $Y_prime_new;
    }

    return $forecast;
}


?>