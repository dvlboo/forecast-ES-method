<?php
  include '../components/dataAction.php';
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
      <?php include '../assets/template/header.php'; ?>
      <div class="row">
        <?php include '../assets/template/leftbar.php'; ?>
        <div class="col-10 data p-5">
          <h3>Dataset</h3>
          <hr>
          <form action="" method="post" enctype="multipart/form-data">
            <span class="fw-bold">Tambah Dataset :</span> 
            <input type="file" name="file" id="file">
            <input class="btn btn-primary" type="submit" name="submit" id="submit" value="submit">
          </form>
          <hr>
          <table class="table table-bordered border-primary">
            <tr class="text-center">
              <th style="width: 60px;">No</th>
              <th>Nama Dataset</th>
              <th class="w-25">Aksi</th>
            </tr>
            <?php $no = 1; ?>
            <?php foreach($datas as $data){ ?>
              <tr>
                <td class="text-center"><?php echo $no; ?></td>
                <td><?php echo $data['nama_dataset_asli'] ?></td>
                <?php $no++; ?>
                <td class="text-center">
                  <a style="text-decoration: none;" href="dataShow.php?id=<?php echo $data['id_dataset'] ?>">
                    <button class="btn btn-success"><i class="bi bi-check-circle"></i>&nbsp; Pilih</button>
                  </a>
                  <a style="text-decoration: none;" href="data.php?id=<?php echo $data['id_dataset'] ?>&aksi=hapus">
                    <button class="btn btn-danger"><i class="bi bi-trash3"></i>&nbsp; Hapus</button>
                  </a>
                </td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
    <?php include '../assets/template/footer.php'; ?>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>