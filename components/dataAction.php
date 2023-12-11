<?php
include 'database/connection.php';

function alert(){
  global $connection;
  if(mysqli_affected_rows($connection) > 0){
    echo "<script> 
        alert('INPUT BERHASIL !') ;
        document.location.href = 'data.php';            
      </script>";
  } else {
    echo "<script> 
      alert('INPUT GAGAL !') ;
      document.location.href = 'data.php';
    </script>";
  }
}

if(isset($_POST["submit"]) && $_POST["submit"] == "submit"){
  $namafile = @$_FILES['file']['name'];
  $tmpname = @$_FILES['file']['tmp_name'];

  $ekssplit = explode('.', $namafile);
  $ekstensi = strtolower(end($ekssplit));

  $namafilebaru = uniqid() . "." . $ekstensi;

  move_uploaded_file($tmpname, 'dataset/'.$namafilebaru);
  
  $query = mysqli_prepare($connection, "INSERT INTO dataset(nama_dataset_asli, nama_dataset_baru) VALUES (?, ?)");
  mysqli_stmt_bind_param($query, "ss", $namafile, $namafilebaru);
  mysqli_stmt_execute($query);
  
  alert();
}

$aksi = @$_GET['aksi'];
$id = @$_GET['id'];

if($aksi == "hapus"){
  mysqli_query($connection, "DELETE FROM dataset WHERE id_dataset='$id'");
}

$datas = mysqli_query($connection, "SELECT * FROM dataset");
?>