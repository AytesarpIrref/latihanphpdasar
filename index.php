<?php  
require 'functions.php';
$games = query("SELECT * FROM game");

// cari dari daftar(failed)
// if (isset ($_POST["cari"]))  {
//   $games= cari($_POST["keyword"]);
// }
// ?>

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
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap"
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
            class="form-control mr-sm-2"
            type="text"
            placeholder="Cari dari daftar"
            aria-label="Search"
          />
          <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="cari">
            Cari
          </button>
        </form>
      </div>
    </nav>

    <div class="d-flex justify-content-center mt-5 mb-5">
      <a class="btn btn-outline-primary" href="tambah.php" role="button"
        >Tambah Daftar (+)</a
      >
    </div>

    <!-- Card -->
    <div class="container-fluid">
      <div class="row justify-content-center">
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
    </div>
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