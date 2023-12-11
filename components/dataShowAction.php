<?php
  include 'database/connection.php';

  $id_dataset = $_GET['id'];

  $datas = mysqli_query($connection, "SELECT * FROM dataset WHERE id_dataset='$id_dataset'");
  $data = mysqli_fetch_array($datas);
  $nama_data = $data['nama_dataset_baru'];

  error_reporting(0);
  include '../assets/spreadsheet-reader/SpreadsheetReader.php';
  $reader = new SpreadsheetReader("../dataset/".$nama_data);

?>