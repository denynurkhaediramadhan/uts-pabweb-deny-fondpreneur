<?php

require 'functions.php';

//tombol daftar sudah di tekan
if(isset($_POST["register"])) {

    if(registrasi($_POST) > 0) {
        echo "<script>
                alert('user baru berhasil ditambahkan!');
                
                </script>";
    } else {
        echo mysqli_error($conn);
    }
}


?>



<html>
<head>
    <title>Halaman Registrasi</title>

    <style> 
        label {
            display: block;
        }
    </style>


</head>

<body>

<!-- Customized Bootstrap Stylesheet -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="css/style.css" rel="stylesheet">

<h1>Halaman Registrasi</h1>

<form action="" method="post">

    <ul>
        <li>
            <label for="username">username : </label>
            <input type="text" name="username" id="username">

        </li>

        <li>
            <label for="password">password : </label>
            <input type="password" name="password" id="password">

        </li>

        <li>
            <label for="password2">konfirmasi password : </label>
            <input type="password" name="password2" id="password2">

        </li>

        <li>
            <button type="submit" name="register">Daftar</button>
        </li>


    </ul>


</form>

</body>
</html>