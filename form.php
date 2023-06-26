<?php
$kodebuku = '';
$judul = '';
$pengarang = '';
$penerbit = '';
$tahunterbit = '';
$cover = '';

if (isset($_GET['kode'])) {
    $kodebuku = $_GET['kode'];

    //mengambil data buku berdasarkan kode
    $file_name = 'buku.txt';
    if (file_exists($file_name)) {
        $read = file($file_name);
        foreach ($read as $buku) {
            $bukuinfo = explode('-', $buku);
            if ($bukuinfo[0] === $kodebuku) {
                $judul = $bukuinfo[1];
                $pengarang = $bukuinfo[2];
                $penerbit = $bukuinfo[3];
                $tahunterbit = $bukuinfo[4];
                $cover = $bukuinfo[5];
                break;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    
</head>

<body>
    <h2 style="padding-left: 550px;">KATALOG PERPUSTAKAAN</h2>
    <form action="simpan.php" method="POST" enctype="multipart/form-data">

        <table>
            <tr>
                <?php
                if (!isset($_GET['kode'])) {
                    echo '<td><label for="kode">Kode Buku</label></td>';
                }
                ?>
                <td><input type="text" name="kode" value="<?php echo $kodebuku; ?>" <?php if (isset($_GET['kode'])) {
                    echo "hidden";
                } ?> placeholder="Masukkan Kode Buku"></td>
            </tr>
            <tr>
                <td><label>Judul</label></td>
                <td><input required type="text" name="judul" id="judul" placeholder="Masukkan Judul" value="<?php echo $judul; ?>" required></td>
                </td>
            </tr>
            <tr>
                <td><label>Pengarang</label></td>
                <td><input type="text" name="pengarang" id="pengarang" placeholder="Masukkan Pengarang" value="<?php echo $pengarang; ?>"></td>
                </td>
            </tr>
            <tr>
                <td><label>Penerbit</label></td>
                <td> <input type="text" name="penerbit" id="penerbit" placeholder="Masukkan Penerbit" value="<?php echo $penerbit; ?>"></td>
                </td>
            </tr>
            <tr>
                <td><label>Tahun Terbit</label></td>
                <td> <input type="text" name="tahunterbit" id="tahunterbit" placeholder="Masukkan Tahun Terbit" value="<?php echo $tahunterbit; ?>"></td>
                </td>
            </tr>
            <tr>
                <td><label>Cover Buku</label></td>
                <?php if (isset($_GET['kode'])) : ?>
                  <td><input type="hidden" name="existing_cover" value="<?php echo $cover; ?>">
                    <?php if (!empty($cover)) : ?>
                        <img src="img/<?php echo $cover; ?>" alt="Cover Buku" width="200">
                        <input type="file" name="cover" accept="image/*">
                    <?php else : ?>
                        <?php if (!empty($_POST['existing_cover'])) : ?>
                            <img src="img/<?php echo $_POST['existing_cover']; ?>" alt="Cover Buku" width="200">
                        <?php else : ?>
                            <p>Tidak ada cover tersedia</p>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php else : ?>
                    <td> <input type="file" name="cover" accept="image/*"></td>
                <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><?php if (isset($_GET['kode'])) : ?>
                        <button type="submit" name="aksi" value="edit">
                            <i aria-hidden="true"></i>
                            Simpan Perubahan
                        </button>
                    <?php else : ?>
                        <button type="submit" name="aksi" value="add">
                            <i aria-hidden="true"></i>
                            Tambahkan
                        </button>
                    <?php endif; ?>
                    <a href="baca.php" type="button">
                        <i aria-hidden="true"></i>
                        Batal
                    </a>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>