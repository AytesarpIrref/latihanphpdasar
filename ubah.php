<?php 
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
require 'functions.php';

// mengambil id dari url
$id = $_GET["id"];

// query data berdasarkan id
$game = query("SELECT * FROM game WHERE id = $id")[0];

// mengecek apakah data sudah diubah
if (isset ($_POST["submit"])) {
  if (ubah($_POST) > 0) {
    echo "
      <script>
        alert('DATA BERHASIL DIUBAH');
        document.location.href = 'index.php';
      </script>";
  } else {
    echo "
      <script>
        alert('DATA GAGAL DIUBAH');
        document.location.href = 'index.php';
      </script>";
  }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- My CSS -->
    <style>.container{margin-top: 20px;} </style>

    <title>Ubah</title>
  </head>
  <body>
    <div class="container">
      <legend>Ubah Informasi Game</legend>
      <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $game["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $game["img"]; ?>">
        <div class="form-group">
          <label for="nama">Nama Game : </label>
          <input type="text" class="form-control" id="nama" name="nama" value="<?= $game["nama"]; ?>" required>
        </div>
        <div class="form-group">
          <label for="genre">Genre : </label>
          <input type="text" class="form-control" id="genre" placeholder="Masukkan genre game" name="genre" value="<?= $game["genre"]; ?>" required>
        </div>
        <div class="form-group">
          <label for="dev">Developer : </label>
          <input type="text" class="form-control" id="dev" placeholder="Masukkan developer/pengembang game" name="dev" value="<?= $game["dev"]; ?>" required>
        </div>
        <div class="form-group">
          <label for="rilis">Tanggal Rilis : </label>
          <input type="text" class="form-control" id="rilis" placeholder="Masukkan tanggal rilis game" name="rilis" value="<?= $game["rilis"]; ?>" required>
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput2">Versi : </label>
          <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan versi game saat ini" value="<?= $game["versi"]; ?>" name="versi">
        </div>
        <label style="display: block;">Gambar : </label>
        <img src="img/<?= $game["img"]; ?>" alt="..." />
        <div class="form-group mt-2">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile" name="img">
            <label class="custom-file-label" for="customFile">Ganti gambar</label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Kirim</button>
      </form>
      <a class="btn btn-danger mt-2" href="index.php" role="button">Batal (X)</a>
    </div>
    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
  </body>
</html>