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

    
    $result = $conn->query("SELECT * FROM mahasiswa WHERE nim='$nim'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama = $row['nama_mhs'];
        $alamat = $row['alamat'];
        $foto = $row['foto'];
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
} else {
    echo "NIM mahasiswa tidak ada!";
    exit;
}


if (isset($_POST['update'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

 
    if ($_FILES['fotomhs']['name']) {
        $target_dir = "uploads/";
        $foto = basename($_FILES["fotomhs"]["name"]);
        $target_file = $target_dir . $foto;


        if (move_uploaded_file($_FILES["fotomhs"]["tmp_name"], $target_file)) {
        
            $sql = "UPDATE mahasiswa SET nama_mhs='$nama', alamat='$alamat', foto='$foto' WHERE nim='$nim'";
        } else {
            echo "Error uploading file.";
        }
    } else {
 
        $sql = "UPDATE mahasiswa SET nama_mhs='$nama', alamat='$alamat' WHERE nim='$nim'";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<html>
<head>
    <title>Edit Mahasiswa</title>
    <link rel="stylesheet" href="assets/style.css" type="text/css">
</head>
<body>

    <header>
        <h1>Edit Mahasiswa</h1>
        <nav>
            <a href="index.php">Home</a>
        </nav>
    </header>

    <article>
        <form action="edit.php?nim=<?php echo $nim; ?>" method="post" enctype="multipart/form-data">
            <table width="25%" border="0">
                <tr> 
                    <td>NIM</td>
                    <td><input type="text" name="nim" value="<?php echo $nim; ?>" readonly></td>
                </tr>
                <tr> 
                    <td>Nama Mahasiswa</td>
                    <td><input type="text" name="nama" value="<?php echo $nama; ?>"></td>
                </tr>
                <tr> 
                    <td>Alamat</td>
                    <td><textarea name="alamat" cols="50" rows="5"><?php echo $alamat; ?></textarea></td>
                </tr>
                <tr> 
                    <td>Upload Foto</td>
                    <td>
                        <img src="uploads/<?php echo $foto; ?>" width="100"><br>
                        <input type="file" name="fotomhs">
                    </td>
                </tr>
                <tr> 
                    <td></td>
                    <td><input type="submit" name="update" value="Update"></td>
                </tr>
            </table>
        </form>
    </article>

    <footer class="article-meta">
        Copyright - All Right Reserved
    </footer>

</body>
</html>
