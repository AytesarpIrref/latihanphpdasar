<?php 
require '../functions.php';
$games= cari($_GET["keyword"]);
?>
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