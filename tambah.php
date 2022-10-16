<?php

session_start();

//cek session login atau belum

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");

    exit;

}


require 'functions.php';

//koneksi ke DBMS
//$conn = mysqli_connect("localhost", "root", "", "fondpreneur");

//cektombol submit sudah ditekan atau belum

if(isset($_POST["submit"])){

    //var_dump($_POST);
    //var_dump($_FILES);
    //die;


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

    //cek apakah data berhasil ditambahkanapa tidak
    if(tambah($_POST) > 0 ){
        echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    }
}
?>


<html>
<head>
    <title>Tambah Data Buku</title>
</head>

<body>
    <h1>Tambah Data Buku</h1>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            
                <label for="nama_buku">Nama Buku : </label>
                <input type="text" name="nama_buku" id="nama_buku" required>

                <br>
          

            
                <label for="deskripsi">Deskripsi : </label>
                <input type="text" name="deskripsi" id="deskripsi" required>

           
<br>
           
                <label for="harga">Harga Buku : </label>
                <input type="text" name="harga" id="harga" required>

            
<br>
            
                <label for="link_produk">Link Buku : </label>
                <input type="text" name="link_produk" id="link_produk" required>

          
<br>

            
                <label for="gambar">Gambar Buku : </label>
                <input type="file" name="gambar" id="gambar" required>
<br>




            
<br>

                <button type="submit" name="submit">Tambahkan Data!</button>
            
        </ul>


    </form>   


</body>
</html>
