<?php
  include '../components/dataShowAction.php';
?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Bootstarp Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Style CSS -->
    <link rel="stylesheet" href="../assets/style/style.css">

    <title>Forecasting Double Exponential Smoothing</title>
  </head>
  <body>
    <div>
      <?php include '../assets/template/header.php';?>
      <div class="row">
        <?php include '../assets/template/leftbar.php'; ?>
        <div class="col-10 p-5 datashow">
          <h3 class="fw-bold"><?php echo $data['nama_dataset_asli'] ?></h3>
          <hr>
          <div class="wrapper mb-3">
            <table class="table table-bordered border-primary">
              <tr class="text-center">
                <th>Periode</th>
                <th>Data Aktual</th>
              </tr>
              <tr>
                <td>
                <?php foreach($reader as $tgl): ?>
                  <?php if($count==0): $count++; continue; endif; ?>
                  <?php echo $tgl[0]."<br>"; ?>
                  <?php $count++; ?>
                <?php endforeach; ?>
                </td>
                <td>
                <?php foreach($reader as $nilai): ?>
                  <?php if($count1==0): $count1++; continue; endif; ?>
                  <?php echo $nilai[1]."<br>"; ?>
                  <?php $count1++; $temp_val[] = $nilai[1]; ?>
                <?php endforeach; ?>
                </td>
              </tr>
            </table>
          </div>
          <form method="post" action="forecast.php" class="row">
            <input type="hidden" name="id" value="<?php echo $data['id_dataset'] ?>">
            <div class="col-6">
              <span class="fw-bold fs-4 text-danger">&alpha;</span> = <input type="text" name="alpha" id="alpha" class="col-label-sm" placeholder=" contoh : 0.1"> 
            </div>
            <div class="col-6 text-end">
              <button class="btn btn-primary ">Next <i class="bi bi-chevron-right"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php include '../assets/template/footer.php';?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>