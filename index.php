<?php

session_start();
if(!$_SESSION['username']){
    header('Location: login.php');
}

$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "kemahasiswaan";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$result = $conn->query("SELECT * FROM mahasiswa");

?>

<html>
<head>
    <title>Portal Kemahasiswaan</title>
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
        <a href="add.php">Tambah Mahasiswa</a><br/>
        <p>Dashboard -<?php echo $_SESSION['username']?>
        <a href="login_logout.php">Logout</a>
    </p><br/>
        

        <table width='100%' border=0>
            <thead bgcolor='#CCCCCC'>
                <tr>
                    <td>NIM</td>
                    <td>Nama</td>
                    <td>Alamat</td>
                    <td>Foto</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
            <?php
            // Display data mahasiswa
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $nim = $row['nim'];  // Assuming 'nim' exists in the table
                    $nama = $row['nama_mhs'];
                    $alamat = $row['alamat'];
                    $foto = $row['foto'] ? $row['foto'] : 'default.jpg'; // Default foto if not exists

                    echo "<tr>";
                    echo "<td>" . $nim . "</td>";
                    echo "<td>" . $nama . "</td>";
                    echo "<td>" . $alamat . "</td>";
                    echo "<td><img src='uploads/" . $foto . "' width='100'></td>";
                    echo "<td>
                            <a href='detail.php?nim=" . $nim . "'>Detail</a> | 
                            <a href='edit.php?nim=" . $nim . "'>Edit</a> | 
                            <a href='delete.php?nim=" . $nim . "' onClick=\"return confirm('Apakah Anda Yakin Ingin Menghapus Mahasiswa Ini?')\">Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Tidak ada data mahasiswa.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </article>

    <footer class="article-meta">
        Copyright - All Right Reserved
    </footer>

</body>
</html>
