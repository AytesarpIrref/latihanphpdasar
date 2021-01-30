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
  $versi = htmlspecialchars($data["versi"]);

  
  // upload gambar
  $img = upload();
  if (!$img) {
    return false;
  }

  $query = "INSERT INTO game VALUES ('', '$nama', '$genre', '$dev', '$rilis', '$img', '$versi')";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function upload(){
  $namaFile = $_FILES['img']['name'];
  $ukuranFile = $_FILES['img']['size'];
  $error = $_FILES['img']['error'];
  $tmpName = $_FILES['img']['tmp_name'];

  // cek apakah gambar sudah diupload
  if ($error === 4) {
    echo "<script>
    alert('pilih gambar terlebih dahulu');
    </script>";
    return false;
  }

  // cek apakah yang dikirim adalh gambar
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo "<script>
    alert('yang anda upload bukan gambar!');
    </script>";
    return false;
  }

  // cek jika ukuran terlalu besar
  if ($ukuranFile > 1000000) {
    echo "<script>
    alert('ukuran gambar terlalu besar!');
    </script>";
    return false;
  }

  // lolos pengecekan, generate nama baru
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiGambar;

  move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
  return$namaFileBaru;
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
  $versi = htmlspecialchars($data["versi"]);
  $gambarLama = htmlspecialchars($data["gambarLama"]);

  if ($_FILES['img']['error'] === 4) {
    $img = $gambarLama;
  } else {
    $img = upload();
  }

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

function registrasi ($data){
  global $conn;

  $username = strtolower(stripslashes($data["username"]));
  $password = mysqli_real_escape_string($conn, $data['password']);
  $password2 = mysqli_real_escape_string($conn, $data['password2']);

  // cek username sudah ada atau belum
  $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

  if (mysqli_fetch_assoc($result)) {
    echo "<script>
        alert('USERNAME SUDAH TERDAFTAR!');
      </script>";
      return false;
  }

  // cek konfirmasi password
  if ($password !== $password2) {
    echo "<script>
        alert('KONFIRMASI PASSWORD TIDAK SESUAI!');
      </script>";
      return false;
  }
  
  // enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);
  
  // tambahkan userbaru ke database
  mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

  return mysqli_affected_rows($conn);

  

}
?>



