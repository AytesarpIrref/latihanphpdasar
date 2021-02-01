<?php  
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
require 'functions.php';

// pagination
$jumlahDataPerHalaman = 4;
$jumlahData = count(query("SELECT * FROM game"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["page"])) ? $_GET['page']:1;
$dataAwal = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


$games = query("SELECT * FROM game LIMIT $dataAwal, $jumlahDataPerHalaman");

// cari dari daftar(failed)
if (isset ($_POST["cari"]))  {
  $games= cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
      integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l"
      crossorigin="anonymous"
    />

    <!-- My Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?$jumlahDatafamily=Roboto:wght@300;400;500&display=swap"
      rel="stylesheet"
    />

    <!-- My CSS -->
    <style>
      ul {
          display: inline-block;
          list-style: none;
          font-weight: 300;
          text-align: center;
        }
    </style>
    


    <title>Latihan PHP</title>
  </head>
  <body>

    <!-- Navbar -->
    <nav
      class="navbar navbar-expand-lg navbar-dark bg-primary font-weight-bold px-5"
    >
      <a class="navbar-brand" href="#">Daftar Game</a>
      <button
        class="navbar-toggler btn-outline-primary"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto"></ul>
        <form class="form-inline my-2 my-lg-0" method="POST">
          <input
            name="keyword"
            class="form-control mr-sm-2 keyword"
            type="text"
            placeholder="Error"
            aria-label="Search"
            autocomplete="off"
          />
          <button class="btn btn-outline-light my-2 my-sm-0 cari" type="submit" name="cari">
            Cari
          </button>
        </form>
      </div>
    </nav>

    <div class="d-flex justify-content-end">
      <a class="btn btn-danger m-2" href="logout.php" role="button">LogOut</a>
    </div>
    

    <div class="d-flex justify-content-center mb-5">
      <a class="btn btn-outline-primary" href="tambah.php" role="button"
        >Tambah Daftar (+)</a
      >
    </div>

    <!-- Card -->
    <div class="container-fluid">
      <div class="row justify-content-center">
        <?php if (empty($games)) : ?>
          <div class="alert alert-danger" role="alert">
            Data game tidak ditemukan...!
          </div>
        <?php endif; ?>
        <?php foreach($games as $game) : ?>
          <div class="col-xl-3 col-lg-4 col-md-6 col-12 justify-content-center">
            <div class="container">
              <div
                class="row text-center mb-5 mx-auto"
                style="
                  width: 280px;
                  height: 400px;
                  padding: 5px;
                  box-sizing: border-box;
                  font-family: 'Roboto', Arial, Helvetica, sans-serif;
                  box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
                  background-color: white;
                "
              >
                <div class="col-lg-12 mt-3">
                  <img src="img/<?= $game["img"]; ?>" alt="..." />
                </div>

                <div class="col-lg-12">
                  <h5 class="card-title mx-auto"><?= $game["nama"]; ?></h5>
                </div>

                <div class="col-lg-12">
                  <ul class="list-group mb-3">
                    <li>Genre : <?= $game["genre"]; ?></li>
                    <li>Developer : <?= $game["dev"]; ?></li>
                    <li>Tanggal rilis : <?= $game["rilis"]; ?></li>
                    <li>Versi : <?= $game["versi"]; ?></li>
                  </ul>
                </div>
                
                <div class="col p-1">
                  <a href="ubah.php?id=<?= $game["id"]; ?>" class="btn btn-primary btn-block">Ubah</a>
                  <a href="hapus.php?id=<?= $game["id"]; ?>" onclick="return confirm('Yakin ingin menghapus item ini?');" class="btn btn-danger btn-block">Hapus</a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <?php if($halamanAktif > 1) : ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?= $halamanAktif - 1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li> 
          <?php else : ?>
            <li class="page-item disabled">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li> 
          <?php endif; ?>
          
          <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
            <?php if($i == $halamanAktif) : ?>
              <li class="page-item active" aria-current="page">
                <a class="page-link" href="?page=<?=$i; ?>"><?= $i; ?></a>
              </li>
            <?php else : ?>
              <li class="page-item">
                <a class="page-link" href="?page=<?=$i; ?>"><?= $i; ?></a>
              </li>
            <?php endif; ?>
          <?php endfor; ?>
          <?php if($halamanAktif < $jumlahHalaman) : ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?= $halamanAktif + 1; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li> 
          <?php else : ?>
            <li class="page-item disabled">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li> 
          <?php endif; ?>
        </ul>
      </nav>
    </div>

    <script src="js/script.js"></script>
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
      crossorigin="anonymous"
    ></script>
  </body>
</html>