<?php

session_start();

//cek session login atau belum

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");

    exit;

}

require 'functions.php';

//ambil data di url
$id = $_GET["id"];
//query data fondpreneur berdasarkan id
$buku = query("SELECT * FROM fondpreneur WHERE id = $id")[0];
//var_dump($buku["nama_buku"]);


//koneksi ke DBMS
//$conn = mysqli_connect("localhost", "root", "", "fondpreneur");

//cektombol submit sudah ditekan atau belum

if(isset($_POST["submit"])){
    // ambil data dari tiap elemen dalam form
    //$nama_buku = $_POST["nama_buku"];
    //$deskripsi = $_POST["deskripsi"];
    //$harga = $_POST["harga"];
    //$link_produk = $_POST["link_produk"];
    //$gambar = $_POST["gambar"];


    //query insert data
    //$query = "INSERT INTO fondpreneur
               // VALUES
               // ('','$nama_buku', '$deskripsi', '$harga', '$link_produk', '$gambar')";
    //mysqli_query($conn, $query);

    //cek apakah data berhasil ditambahkan atau tidak
    //var_dump(mysqli_affected_rows($conn));

    /* if(mysqli_affected_rows($conn) > 0) {
        echo "berhasil";
    } else {
        echo "gagal!";
        echo "<br>";
        echo mysqli_error($conn);

    }
    */

    //cek apakah data berhasil di ubah apa tidak
    if(ubah($_POST) > 0 ){
        echo "
            <script>
                alert('data berhasil diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    }
}
?>


<html>
<head>
    <title>Ubah Data Buku</title>
</head>

<body>
    <h1>Ubah Data Buku</h1>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $buku["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $buku["gambar"]; ?>">


        <ul>
            <li>
                <label for="nama_buku">Nama Buku : </label>
                <input type="text" name="nama_buku" id="nama_buku" required
                value="<?= $buku["nama_buku"]; ?>">

            </li>

            <li>
                <label for="deskripsi">Deskripsi : </label>
                <input type="text" name="deskripsi" id="deskripsi" required
                value="<?= $buku["deskripsi"]; ?>">

            </li>

            <li>
                <label for="harga">Harga Buku : </label>
                <input type="text" name="harga" id="harga" required
                value="<?= $buku["harga"]; ?>">

            </li>

            <li>
                <label for="link_produk">Link Buku : </label>
                <input type="text" name="link_produk" id="link_produk" required
                value="<?= $buku["link_produk"]; ?>">

            </li>

            <li>
                <label for="gambar">Gambar Buku : </label> <br>

                <img src="img/<?= $buku['gambar']; ?>" 
                width=120 > <br>

                <input type="file" name="gambar" id="gambar">

            </li>

            <li>
                <button type="submit" name="submit">Ubah Data!</button>
            </li>
        </ul>


    </form>   


</body>
</html>