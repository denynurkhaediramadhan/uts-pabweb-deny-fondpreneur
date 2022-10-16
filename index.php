<?php

session_start();

//cek session login atau belum

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");

    exit;

}

// koneksi database

require 'functions.php';
$buku = query("SELECT * FROM fondpreneur ORDER BY id ASC");

//tombol cari di tekan
if(isset($_POST["cari"])) {
    $buku = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Admin</title>
<!-- Customized Bootstrap Stylesheet -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="css/style.css" rel="stylesheet">


</head>

<body>





<center> <h1>DAFTAR PRODUK BUKU BY FONDPRENEUR</h1> </center>


<br>


<form action="" method="post">

    <input type="text" name="keyword" size="40" autofocus 
    placeholder="Masukan Data Yang Akan Dicari..." autocomplete="off">

    <button type="submit" name="cari">Cari Data</button>

    <a href="tambah.php">Tambah Data Buku</a>


    <a href="upload_data.php">Upload Data Excel</a>


    <a href="grafik.php">Lihat Grafik Harga Buku</a>


</form>

<br>

<table class="tabel1" border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>NO.</th>
        <th>Aksi</th>
        <th>Nama Buku</th>
        <th>Deskripsi</th>
        <th>Harga</th>
        <th>Link</th>
        <th>Gambar</th>
    </tr>


    <?php $i = 1; ?>
    <?php foreach($buku as $row) : ?>
    <tr>
        <td><?= $i; ?></td>
        <td>
            <a href="ubah.php?id=<?= $row["id"];?>">ubah</a>

            
            <a href="hapus.php?id=<?= $row["id"];?>" onclick="return confirm('apakah kamu yakin menghapus data ini?');">hapus</a>
        </td>
        <td><?= $row["nama_buku"]; ?></td>
        <td><?= $row["deskripsi"]; ?></td>
        <td><?= $row["harga"]; ?></td>
        <td><?= $row["link_produk"]; ?></td>
        <td><img src="img/<?= $row["gambar"];?>" width="100"></td>

            
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>


</table>

<a href="logout.php">Logout</a>

</body>


</html>