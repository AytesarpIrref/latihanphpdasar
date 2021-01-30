<?php 
$conn = mysqli_connect("localhost", "root", "", "latihanphp");

function query($query){
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}


function tambah($data){
  global $conn;
  $nama = htmlspecialchars($data["nama"]);
  $genre = htmlspecialchars($data["genre"]);
  $dev = htmlspecialchars($data["dev"]);
  $rilis = htmlspecialchars($data["rilis"]);
  $img = htmlspecialchars($data["img"]);
  $versi = htmlspecialchars($data["versi"]);

  $query = "INSERT INTO game VALUES ('', '$nama', '$genre', '$dev', '$rilis', '$img', '$versi')";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function hapus($id) {
  global $conn;
  mysqli_query($conn, "DELETE FROM game WHERE id = $id");

  return mysqli_affected_rows($conn);
}

function ubah($data){
  global $conn;
  $id = $data["id"];
  $nama = htmlspecialchars($data["nama"]);
  $genre = htmlspecialchars($data["genre"]);
  $dev = htmlspecialchars($data["dev"]);
  $rilis = htmlspecialchars($data["rilis"]);
  $img = htmlspecialchars($data["img"]);
  $versi = htmlspecialchars($data["versi"]);

  $query = "UPDATE game SET 
            nama ='$nama',
            genre = '$genre',
            dev = '$dev',
            rilis = '$rilis',
            img = '$img',
            versi = '$versi'
            WHERE id = $id";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

// (Failed)

// function cari($keyword){
//   $query = "SELECT * FROM games 
//               WHERE 
//               nama LIKE '%$keyword%' OR
//               genre LIKE '%$keyword%' OR 
//               dev LIKE '%$keyword%' OR
//               rilis LIKE '%$keyword%' OR
//               versi LIKE '%$keyword%'
//             ";
//   return query($query);
// }

?>



