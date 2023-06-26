

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <title>Perpustakaan</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
    <nav>
        <h2 style="padding-left: 550px;">KATALOG BUKU PERPUSTAKAAN</h2>
    </nav>
    <?php
    $file_name = "buku.txt";
    if (file_exists(($file_name))) {
        $read = file($file_name);
        if (count($read) > 0) {
            ?>
            <table border="1" style="margin-left: 400px;">
                <thead>
                    <tr>
                        <th>Kode Buku</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Cover Buku</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($read as $buku) {
                        $isibuku = explode("-", $buku);
                        echo "<tr>";
                        echo '<td>' . $isibuku[0] . '</td>';
                        echo '<td>' . $isibuku[1] . '</td>';
                        echo '<td>' . $isibuku[2] . '</td>';
                        echo '<td>' . $isibuku[3] . '</td>';
                        echo '<td>' . $isibuku[4] . '</td>';
                        echo "<td><img src='img/".$isibuku[5]."' height='100'></td>";
                        ?>
                    <td>
                        <a href="form.php?kode=<?php echo $isibuku[0]; ?>" type="button" class="btn_edit">
                            <i>Edit</i>
                        </a>
                        <a href="delete.php?kode=<?php echo $isibuku[0]; ?>" type="button" class="btn_hapus">
                            <i>Hapus</i>
                        </a>
                    </td>
                </tr>
                <?php
            }

        } else {
            echo '<h3 style="margin-left :50%">Data tidak ada<h3>';
        }
    } else {
        echo '<h3 style="margin-left :50%">File tidak ada<h3>';
    }
    ?>
        </tbody>
    </table>
</body>
<?php
    echo '<br><br><a href="form.php">Kembali ke Form</a>';
?>
</html>