<?php $currentPage = 'home'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  <!-- Bootstarp Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Style CSS -->
  <link rel="stylesheet" href="assets/style/style.css">

  <title>Forecasting Single Exponential Smoothing</title>
</head>
<body>
  <!-- <div class="container-fluid"> -->
    <?php include 'assets/template/header.php'; ?>
    <div class="row">
      <?php include 'assets/template/leftbar.php'; ?>
      <div class="col-md-10">
        <div class="text-center mt-5">
          <!-- <img src="assets/image/LogoUTM.png" width="200px" alt="logo UTM"> -->
          <h1>Tugas Akhir Forecasting</h1>
          <h4>Pada sistem ini dapat digunakan untuk menghitung peramalan satu periode selanjutnya dari data yang dimasukkan ke dalam sistem menggunakan metode forecasting <br> Single Exponential Smoothing</h4>

          <h4>Created By :</h4>

          <div class="text-center mt-5 d-flex justify-content-center">
          <!-- Kolom Kiri -->
          <div class="float-start me-5">
            <img src="assets/image/Kukuh.png" width="200px" class="rounded-circle" alt="Foto Profil Kukuh Cokro Wibowo">
            <div class="mt-3">
              <p class="mb-0">Kukuh Cokro Wibowo</p>
              <p class="mt-0">210441100102</p>
            </div>
          </div>

          <!-- Kolom Kanan -->
          <div class="float-start">
            <img src="assets/image/Kukuh.png" width="200px" class="rounded-circle" alt="Foto Profil Hakiky">
            <div class="mt-3">
              <p class="mb-0">Hakiky</p>
              <p class="mt-0">210441100000</p>
            </div>
          </div>
        </div>


        </div>
      </div>
    </div>
  <!-- </div> -->

  <?php include 'assets/template/footer.php';?>
  <!-- Bootstrap JS scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>