<?php

session_start();

//cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key']))  {
    $id =$_COOKIE['id'];
    $key =$_COOKIE['key'];

    //ambil username berdasarkan nomor id

    $result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    //cek cookie dan username
    if($key === hash('sha256', $row['username'])) {
        $_SESSION['login']= true;
    }
    
}

if ( isset($_SESSION["login"])) {

    header("Location: index.php");

    exit;
}

require 'functions.php';

//cek tombol subit udah ditekan atau belum
if(isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username =
        '$username'");


    //cek username
    if(mysqli_num_rows($result) === 1 ) {

        //cek password
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {

            //set session
            $_SESSION["login"] = true;

            //cek remember me

            if(isset($_POST['remember'])) {
                //buat cookie

                setcookie('id', $row['id'], time()+60);
                setcookie('key', hash('sha256', $row['usernaame']), time()+60);
            }

            header("Location: index.php");

            exit;
        }
    }

    $error = true;
}

?>



<html>
<head>
    <title>Halaman Login</title>

    <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Card</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>

<body>
<div id="card">
    <div id="card-content">
      <div id="card-title">
        <h2>LOGIN</h2>
        <div class="underline-title"></div>
      </div>

<!--<h1>Halaman Login</h1> -->

<!-- Customized Bootstrap Stylesheet -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="css/style.css" rel="stylesheet">

<style> 
body {
       background: -webkit-linear-gradient(bottom, #2dbd6e, #a6f77b);
       background-repeat: no-repeat;
}
#card {
        background: #fbfbfb;
        border-radius: 8px;
        box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
        height: 410px;
        margin: 6rem auto 8.1rem auto;
        width: 329px;
}

#card-content {
      padding: 12px 44px;
}
#card-title {
      font-family: "Raleway Thin", sans-serif;
      letter-spacing: 4px;
      padding-bottom: 23px;
      padding-top: 13px;
      text-align: center;
}
.underline-title {
      background: -webkit-linear-gradient(right, #a6f77b, #2ec06f);
      height: 2px;
      margin: -1.1rem auto 0 auto;
      width: 89px;
}

a {
    text-decoration: none;
}
label {
    font-family: "Raleway", sans-serif;
    font-size: 11pt;
}
#forgot-pass {
    color: #2dbd6e;
    font-family: "Raleway", sans-serif;
    font-size: 10pt;
    margin-top: 3px;
    text-align: right;
}
.form {
    align-items: left;
    display: flex;
    flex-direction: column;
}
.form-border {
    background: -webkit-linear-gradient(right, #a6f77b, #2ec06f);
    height: 1px;
    width: 100%;
}
.form-content {
    background: #fbfbfb;
    border: none;
    outline: none;
    padding-top: 14px;
}

#submit-btn {
    background: -webkit-linear-gradient(right, #a6f77b, #2dbd6e);
    border: none;
    border-radius: 21px;
    box-shadow: 0px 1px 8px #24c64f;
    cursor: pointer;
    color: white;
    font-family: "Raleway SemiBold", sans-serif;
    height: 42.3px;
    margin: 0 auto;
    margin-top: 50px;
    transition: 0.25s;
    width: 153px;
}
#submit-btn:hover {
    box-shadow: 0px 1px 18px #24c64f;
}
Perhatikan baris #submit-btn:hover, hover merupakan CSS selector yang berguna untuk menerapkan style ketika kita mengarahkan cursor mouse ke elemen tersebut.

Bila kita ingin membuat sedikit animasi pada CSS, maka kita perlu membuat 2 style yang berbeda. Pada contoh di atas terdapat style pada #submit-btn dan adapula #submit-btn:hover. Pada #submit-btn kita membuat style utama pada elemen dengan id tersebut, dan pada#submit-btn:hover kita membuat style tambahan ketika cursor mouse diarahkan pada elemen dengan id tersebut. Agar perubahan yang terjadi terlihat mulus maka di dalam #submit-btn kita menambahkan transition: 0.25syang maksudnya adalah ketika kita mengarahkan cursor mouse ke elemen tersebut akan terjadi transisi dengan durasi 250ms.

Untuk memudahkan pemahaman, langsung saja simpan file setelah menyalin teks tersebut dan lakukan refresh pada browser. Coba arahkan cursor mouse kalian pada tombol Login dan perhatikan apa yang terjadi.


Source Code
Apabila masih ada error pada beberapa langkah tersebut, berikut saya berikan source code lengkap untuk mendesain Login Card.




</style>


<?php if(isset($error)) : ?>
    <p style="color: red; font-style: italic;"> username / password yang dimasukan salah</p>
<?php endif; ?>



<form action="" method="post" class="form">

    
        
            <label for="username" style="padding-top:13px">Username : </label>
            <input type="text" class="form-content" name="username" id="username" autocomplete="on" required >

     

       
            <label for="password" style="padding-top:22px" >Password : </label>
            <input type="password" class="form-content" name="password" id="password" required>

        
<br>
        
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember me</label>
            
        
<br>
        
            <button type="submit-btn" name="login">Login</button>
        

   


</form>
</div>
</div>


</body>
</html>