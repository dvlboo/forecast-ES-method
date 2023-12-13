<div class="col-2 text-light leftbar">
  <h3 class="text-center p-2 mt-3">Menu</h3>
  <div class="leftbarMenu">
    <ul>
      <li <?php echo ($currentPage === 'home') ? 'class="active"' : ''; ?>>
        <a href="/forecastingES/index.php"><i class="bi bi-house-door"></i>&nbsp; Home</a>
      </li>
      <li <?php echo ($currentPage === 'data') ? 'class="active"' : ''; ?>>
        <a href="/forecastingES/view/data.php"><i class="bi bi-cloud"></i>&nbsp; Data</a>
      </li>
      <!-- <li <?php echo ($currentPage === 'forecast') ? 'class="active"' : ''; ?> >
        <a href="/forecastingES/view/forecast.php"><i class="bi bi-clipboard-data"></i>&nbsp; Forecasting</a>
      </li> -->
    </ul>
  </div>
</div>
