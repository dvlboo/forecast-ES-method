<?php
include '../components/forecastAction.php';
$currentPage = 'forecast';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/style/style.css">

    <title>Forecasting Single Exponential Smoothing</title>
</head>
<body>
<div>
    <?php include '../assets/template/header.php'; ?>
    <div class="row">
      <?php include '../assets/template/leftbar.php'; ?>
        <div class="col-10 p-5 forecast">
            <h3 class="fw-bold text-center">FORECASTING</h3>
            <hr>
            <div class="row mb-3">
                <div class="col-6">
                    <span class="fw-bold fs-4 text-danger">&alpha;</span> = <span
                            class="fw-bold text-danger"><?php echo $alpha; ?></span>
                </div>
                <form method="post" action="forecast.php" class="col-12">
                    <input type="hidden" name="id" value="<?php echo $id_dataset ?>">
                    <div class="row">
                        <div class="col-6">
                            <span class="fw-bold">Ganti </span>
                            <span class="fs-5 fw-bold">&alpha;</span>
                            =
                            <input type="text" name="alpha" id="alpha" class="col-label-sm"
                                   placeholder=" contoh : 0.1">
                            <button class="btn btn-primary">Ganti </i></button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="wrapper mb-3">
                <table class="table table-bordered border-primary">
                    <tr class="text-center">
                        <th>Periode</th>
                        <th>Data</th>
                        <th>Forecast</th>
                        <th>Mape</th>
                    </tr>
                    <tr>
                        <td>
                            <?php foreach ($reader as $count => $tgl): ?>
                                <?php if ($count == 0) continue; ?>
                                <?php echo $tgl[0] . "<br>"; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <?php
                            $temp_val = [];
                            foreach ($reader as $count1 => $nilai) {
                                if ($count1 == 0) continue;
                                echo $nilai[1] . "<br>";
                                $temp_val[] = $nilai[1];
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            // Panggil function perhitungan single exponential
                            $hasil_fc = singleExponentialSmoothing($temp_val, $alpha);

                            // Tampilkan hasil peramalan di tabel
                            foreach ($hasil_fc as $hasil) {
                                echo number_format($hasil, 2, ".", "") . "<br>";
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            $mape = [];
                            foreach ($hasil_fc as $i => $hasil) {
                                // Memastikan tidak terjadi pembagian oleh nol
                                if ($temp_val[$i] != 0) {
                                    $y = abs(($temp_val[$i] - $hasil) / $temp_val[$i]) * 100;
                                    echo number_format($y, 2, ".", "") . "<br>";
                                    $mape[] = $y;
                                } else {
                                    echo "- <br>";
                                    $mape[] = null; // Menambahkan nilai null untuk menandai pembagian oleh nol
                                }
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
            <h4>
                Hasil Forecast 1 periode kedepan :
                <?php
                // Panggil function perhitungan single exponential
                $hasil_fc = singleExponentialSmoothing($temp_val, $alpha);

                // Ambil nilai forecast terakhir (1 periode ke depan)
                $hasil_akhir = end($hasil_fc);

                // Ambil data aktual terbaru
                $latest_data_point = end($temp_val);

                // Hitung forecast untuk satu periode ke depan secara manual
                $new_data_point = $alpha * $latest_data_point + (1 - $alpha) * $hasil_akhir;

                // Format dan tampilkan hasil forecast satu periode ke depan
                $new_data_point_format = number_format($new_data_point, 2, ".", "");
                echo "<span class='text-danger fw-bold'>" . $new_data_point_format . "</span>";
                ?>
            </h4>

            <h4>
                MAPE :
                <?php
                $mape_akhir = array_sum($mape) / count($mape);
                $mape_akhir_format = number_format($mape_akhir, 2, ".", "");
                echo "<span class='text-danger fw-bold'>" . $mape_akhir_format . "% </span>";
                ?>
            </h4>

            <div>
              <canvas id="forecastChart" height="600px"></canvas>
            </div>
          </div>
    </div>
</div>

<?php include '../assets/template/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/script/chart.min.js"></script>

<script>
  <?php
  $labels = [];
  $temp_val = [];

  foreach ($reader as $count => $tgl) {
      if ($count == 0) continue;
      $labels[] = $tgl[0];
      $temp_val[] = $tgl[1];
  }
  ?>

    // Ambil elemen canvas
    var ctx = document.getElementById('forecastChart').getContext('2d');

    // Panggil function perhitungan single exponential
    var hasil_fc = <?php echo json_encode(singleExponentialSmoothing($temp_val, $alpha)); ?>;
    var labels = <?php echo json_encode($labels); ?>;

    // Inisialisasi dan gambar grafik
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Actual Data',
                data: <?php echo json_encode(array_values($temp_val)); ?>,
                borderColor: 'blue',
                fill: false
            }, {
                label: 'Forecast',
                data: hasil_fc,
                borderColor: 'red',
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: {
                    type: 'linear',
                    position: 'bottom'
                }
            }
        }
    });
</script>


</body>
</html>