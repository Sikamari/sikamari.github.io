<?php
session_start();
require 'functions.php';

// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id=$id"); //diisi hanya dengan username
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

// cek apakah user masuk melalui login.php atau tidak
// !isset = jika $_SESSION["login"] tidak ada, maka tendang ke halaman login.php
if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}


// Tombol login sudah dipencet atau belum
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    // cek username
    if (mysqli_num_rows($result) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($result); //disini isinya ID dan username dari database
        if (password_verify($password, $row["password"])) {

            // set session
            $_SESSION["login"] = true;

            //cek remember me
            if (isset($_POST['remember'])) {

                // buat cookie berdasarkan ID
                setcookie('id', $row['id'], time() + 60);

                //buat cookie berdasarkan username
                $hashUsername = hash('sha256', $row['username']);
                setcookie('key', $hashUsername);
            }

            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.4.1.min.js"></script>

    <style>
        label.label {
            display: block;
        }
    </style>

</head>

<body>


    <?php if (isset($error)) : ?>
        <p style="color: red; ">username / password salah</p>
    <?php endif; ?>

    <form action="" method="post" class="login-form">
        <h1>Login</h1>

        <div class="txtb">
            <input type=text name="username" id="username" autocomplete="off">
            <span data-placeholder="Username"></span>
        </div>
        <div class="txtb">
            <input type="password" name="password" id="password">
            <span data-placeholder="Password"></span>
        </div>

        <input type=checkbox name="remember" id="remember">
        <label for="remember">Remember Me</label><br>

        <button type="submit" name="login" class="logbtn">Login</button>


    </form>

    <script type="text/javascript">
        $(".txtb input").on("focus", function() {
            $(this).addClass("focus");
        });

        $(".txtb input").on("blur", function() {
            if ($(this).val() == "")
                $(this).removeClass("focus");
        });
    </script>
</body>

</html>