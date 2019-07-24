<?php
// cek apakah user masuk melalui login.php atau tidak
// !isset = jika $_SESSION["login"] tidak ada, maka tendang ke halaman login.php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require "functions.php";

// ambil data di URL
$id = $_GET["id"];
// var_dump($id);

// query data mahasiswa berdasarkan ID
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];
// mengapa [0]? karena isi dari data detailnya berada di dalam array (array dalam array)
var_dump($mhs);


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    // cek apakah data berhasil diubah atau tidak
    if (ubah($_POST) > 0) {
        echo "
        <script>alert('data berhasil diubah');
        document.location.href='index.php';

        </script>";
    } else {
        echo "<script>
        alert('data gagal diubah');
        document.location.href='index.php';
        </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ubah Data</title>
</head>

<body>
    <h1>Ubah data mahasiswa</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
        <ul>
            <li>
                <label for="nama">Nama : </label><input type="text" name="nama" id="nama" value="<?= $mhs["nama"]; ?>">
            </li>
            <li>
                <label for="nrp">NRP : </label><input type="text" name="nrp" id="nrp" required value="<?= $mhs["nrp"]; ?>"></li>
            <li>
                <label for="email">Email : </label><input type="text" name="email" id="email" value="<?= $mhs["email"]; ?>">
            </li>
            <li>
                <label for="jurusan">Jurusan : </label><input type="text" name="jurusan" id="jurusan" value="<?= $mhs["jurusan"]; ?>">
            </li>
            <li>

                <label for="gambar">Gambar : </label><br>
                <img src="cover/<?= $mhs["gambar"];  ?>" width="40">
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Ubah Data</button>
            </li>
        </ul>
    </form>
    <!-- <?php var_dump($_POST); ?> -->
</body>

</html>