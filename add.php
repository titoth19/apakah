<?php
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "kemahasiswaan";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $img_name = $_FILES['fotomhs']['name'];
    $img_tmp_name = $_FILES['fotomhs']['tmp_name'];

   
    $target_dir = __DIR__ . "/uploads/"; 
    $target_file = $target_dir . basename($img_name);

  
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
    }


    if (move_uploaded_file($img_tmp_name, $target_file)) {
     
        $querySQL = "INSERT INTO mahasiswa (nim, nama_mhs, alamat, foto) 
                     VALUES ('$nim', '$nama', '$alamat', '$img_name')";

        if ($conn->query($querySQL) === TRUE) {
            header('Location: index.php');
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}
?>

<html>
    <head>
        <title>Tambah Mahasiswa</title>
        <link rel="stylesheet" href="assets/style.css" type="text/css">
    </head>
    <body>

        <header>
            <h1>Kemahasiswaan Poltek</h1>
            <nav>
                <a href="index.php">Home</a>
            </nav>
        </header>

        <article>
            <p>Tambah Mahasiswa</p>
            <br/><br/>

            <form action="add.php" method="post" name="form1" enctype="multipart/form-data">
                <table width="25%" border="0">
                    <tr> 
                        <td>NIM</td>
                        <td><input type="text" name="nim"></td>
                    </tr>
                    <tr> 
                        <td>Nama Mahasiswa</td>
                        <td><input type="text" name="nama"></td>
                    </tr>
                    <tr> 
                        <td>Alamat</td>
                        <td><textarea name="alamat" cols="50" rows="5"></textarea></td>
                    </tr>
                    <tr>
                        <td>Upload Foto</td>
                        <td><input type="file" name="fotomhs" id="fileToUpload"></td>
                    </tr>
                    <tr> 
                        <td></td>
                        <td><input type="submit" name="submit" value="Add"></td>
                    </tr>
                </table>
            </form>
        </article>

        <footer class="article-meta">
            Copyright - All Right Reserved
        </footer>

    </body>
</html>
