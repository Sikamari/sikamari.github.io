<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");
// ===========================================
// MENAMPILKAN DATA dalam halaman admin
function query($query)
{
    global $conn; //variabel scope local menjadi global
    $result = mysqli_query($conn, $query); //lemarinya
    $rows = []; // wadah proses ngambil baju dari lemarinya
    while ($row = mysqli_fetch_assoc($result)) #simpan isi tabel ke dalam asosiative array variabel $row
    {
        $rows[] = $row;
    }
    return $rows;
}
// ===========================================
// MENAMBAH DATA
function tambah($data)
{
    global $conn;

    // ambil data dari tiap elemen dalam form tambah.php 
    $nama = htmlspecialchars($data["nama"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    // upload gambar 
    // cek apakah gambar telah di upload   
    $gambar = upload();
    if (!$gambar) { // sama aja kayak $gambar===false
        return false;
    }

    // query insert data
    $query = "INSERT INTO mahasiswa
            VALUES
            ('','$nama','$nrp','$email','$jurusan','$gambar')"; // harus urut seperti di phpmyadmin
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
    // jika gagal memengeruhi tabel $conn akan menghasilkan interger -1,
    // jika berhasil memengeruhi tabel $conn akan menghasilkan interger 1
}
// =========================================
// Upload Gambar

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // mengecek apakah gambar sudah diupload
    if ($error === 4) {
        echo "<script> 
            alert('pilih gambar untuk diupload')
            </script>";
        return false;
    }
    // mengecek apakah yang diupload gambar atau bukan
    $ekstensiGambarValid = [
        'jpg', 'jpeg',
        'png'
    ];
    $ekstensiGambar = explode('.', $namaFile); // memecah string berdasarkan 'titik' ke dalam array
    $ekstensiGambar = strtolower(end($ekstensiGambar)); //mengambil array paling akhir
    // rubah array yang diambil menjadi huruf kecil

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script> 
            alert('yang anda upload bukan gambar')
            </script>";
    } // jika ekstensi gambar yang diupload user tidak ada dalam $ekstensiGambarValid, data ditolak

    // cek jika ukurannya terlalu besar (dalam byte)
    if ($ukuranFile > 1000000) {
        echo "<script> 
            alert('ukuran gambar terlalu besar')
            </script>";
        // satuannya byte
    }

    // lolos pengecekan gambar
    // generate nama file baru
    $namaFileBaru = uniqid(); //filename akan menjadi acak
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'cover/' . $namaFileBaru);
    return $namaFileBaru;
}
// =========================================
// Hapus Data
function hapus($id)
{
    # code...
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id=$id");
    return mysqli_affected_rows($conn);
}

// ====================================
// Ubah Data

function ubah($data)
{
    global $conn;

    // ambil data dari tiap elemen dalam form ubah11.php baris 16

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    // apakah user mengupload gambar
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    // query ubah data
    $query = "UPDATE mahasiswa SET 
                nama = '$nama',
                nrp = '$nrp',
                email = '$email',
                jurusan = '$jurusan',
                gambar = '$gambar'
            
            -- mengunci berdasarkan primary key nya
            WHERE id = $id
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
    // jika ada data yang berubah menghasilkan nilai 1
}
// =========================================
// MENCARI DATA

function cari($keyword)
{
    $query = ("SELECT * FROM mahasiswa
                WHERE
                nama LIKE '%$keyword%' OR
                nrp LIKE '%$keyword%' OR
                email LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%'
    ");
    return query($query);
}
// =========================================
// REGISTRASI USER

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]); //menerjemahkan karakter khusus ke dalam karakter SQL
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username' ");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('username sudah terdaftar!');
            </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
        alert('konfirmasi password tidak sesuai');
        </script>";
        return false;
    }

    // enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT); //algo nya default dari php

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES ('','$username','$password')");

    return mysqli_affected_rows($conn);
}
