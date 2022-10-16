<?php

$conn = mysqli_connect("localhost", "root", "", "fondpreneur");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
               while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {
    global $conn;

    $nama_buku = htmlspecialchars($data["nama_buku"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $harga = htmlspecialchars($data["harga"]);
    $link_produk = htmlspecialchars($data["link_produk"]);
    //$gambar = htmlspecialchars($data["gambar"]);

    //upload gambar
    $gambar = upload();
    if(!$gambar) {
        return false;
    }

    //query
    $query = "INSERT INTO fondpreneur
            VALUES
            ('','$nama_buku', '$deskripsi', '$harga', '$link_produk', '$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function upload() {
    
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFIle = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];


    //cek apakah tidak ada gambar yang di upload

    if( $error === 4) {
        echo "<script>
                alert('Pilih gambar terlebih dahulu');
             </script>";
        return false;
    }


    //mengechek apakah yang di upload gambar atau bukan
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if( !in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('Yang anda upload bukan gambar!');
             </script>";
        return false;

    }

    //membatasi uk file yang di upload
    if($ukuranFIle > 3000000 ) {
        echo "<script>
                alert('Ukuran gambar terlalu besar!');
             </script>";
        return false;
    }


    //lolos pengecekan, gambar siap di upload

    // generate nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;


    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;


}



function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM fondpreneur WHERE id = $id");

    return mysqli_affected_rows($conn);
}


function ubah($data){
    global $conn;

    $id = $data["id"];

    $nama_buku = htmlspecialchars($data["nama_buku"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $harga = htmlspecialchars($data["harga"]);
    $link_produk = htmlspecialchars($data["link_produk"]);
    
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    
    //cek apakah user pilih gambar bar atau tidak
    if($_FILES['gambar']['error'] ===4 ){
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    //$gambar = htmlspecialchars($data["gambar"]);

    //query
    $query = "UPDATE fondpreneur SET
                nama_buku = '$nama_buku',
                deskripsi = '$deskripsi',
                harga = '$harga',
                link_produk = '$link_produk',
                gambar = '$gambar' 
                WHERE id = $id
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword) {
    $query = "SELECT * FROM fondpreneur
                    WHERE
                nama_buku LIKE '%$keyword%'  OR
                deskripsi LIKE '%$keyword%'  OR
                harga LIKE '%$keyword%'  OR
                link_produk LIKE '%$keyword%' 
                
                ";
    return query($query);
}


function registrasi($data) {

    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);


    //cek username udah ada tau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar!');
        
            </script>";

        return false;
    }


    //cek konfirmasi password

    if($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
        
            </script>";

        return false;
    }

    
    //return 1;

    //enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);


    //tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);

}



?>