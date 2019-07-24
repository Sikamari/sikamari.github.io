<?php

// cek apakah user masuk melalui login.php atau tidak
// !isset = jika $_SESSION["login"] tidak ada, maka tendang ke halaman login.php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require "functions.php";
$id = $_GET["id"];

if (hapus($id) > 0) {
    # code...
    echo "
    <script>alert('data berhasil dihapuskan');
    document.location.href='index.php';
    </script>";
} else {
    # code...
    echo "<script>
        alert('data gagal dihapuskan');
        document.location.href='index.php';
        </script>";
}
