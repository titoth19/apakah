<?php
session_start();
$uname = $_POST['username'];
$pass = $_POST['password'];
$tpassword = md5($pass);
// echo $uname. '-' .$tpassword;

// bagian koneksi
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "kemahasiswaan";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// bagian koneksi
$result = $conn->query("SELECT * FROM admin where username ='$uname' AND password='$tpassword' ");

if ($result->num_rows > 0) {
    // echo 'user valid';
    $row = $result->fetch_assoc();
    $_SESSION['id_admin']= $row['id_admin'];
    $_SESSION['username']= $row['username'];

    header('Location: index.php');

}else{
    echo 'user tidak ditemukan';
}

?>