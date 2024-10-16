<?php
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "kemahasiswaan";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];

  
    $sql = "DELETE FROM mahasiswa WHERE nim='$nim'";

    if ($conn->query($sql) === TRUE) {
      
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "NIM tidak ditemukan!";
}

$conn->close();
?>
