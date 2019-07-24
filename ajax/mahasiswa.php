<?php
require '../functions.php';
$keyword = $_GET["keyword"]; //dari ajax, atas pengiriman melalui URL
$query = "SELECT * FROM mahasiswa
            WHERE
            nama LIKE '%$keyword%' OR
            nrp LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'";
$mahasiswa = query($query);
?>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>NRP</th>
        <th>Nama</th>
        <th>Email </th>
        <th>Jurusan</th>
    </tr>
    <?php $i = 1; ?>
    <?php foreach ($mahasiswa as $row) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td>
                <a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a>
                |
                <a href="hapus.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('yakin')">Hapus</a>
            </td>
            <td>
                <img src="cover/<?php echo $row["gambar"]; ?>" width="100px" height="150px" alt="">
            </td>
            <td>
                <?= $row["nrp"]; ?>
            </td>
            <td>
                <?= $row["nama"]; ?>
            </td>
            <td>
                <?= $row["email"]; ?>
            </td>
            <td>
                <?= $row["jurusan"]; ?>
            </td>
        </tr>
        <?php $i++; ?>

    <?php endforeach; ?>

</table>