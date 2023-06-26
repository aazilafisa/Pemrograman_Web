<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
</head>


<?php
$kodebuku = $_POST['kode'] ?? '';
$judul = $_POST['judul'] ?? '';
$pengarang = $_POST['pengarang'] ?? '';
$penerbit = $_POST['penerbit'] ?? '';
$tahunterbit = $_POST['tahunterbit'] ?? '';

if (isset($_FILES['cover'])) {
    $cover = $_FILES['cover']['name'];
    $cover_tmp = $_FILES['cover']['tmp_name'];
    move_uploaded_file($cover_tmp, 'img/' . $cover);
}

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] === 'add') {
        // Proses penambahan buku
        $buku = $kodebuku . '-' . $judul . '-' . $pengarang . '-' . $penerbit . '-' . $tahunterbit . '-' . $cover . PHP_EOL;
        file_put_contents('buku.txt', $buku, FILE_APPEND);
        header("Location: baca.php");
        exit();
    } elseif ($_POST['aksi'] === 'edit') {
        $kodebuku = $_POST['kode'];
        $judul = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $penerbit = $_POST['penerbit'];
        $tahunterbit = $_POST['tahunterbit'];

        $file_name = 'buku.txt';
        if (file_exists($file_name)) {
            $read = file($file_name);
            $output = '';
            foreach ($read as $buku) {
                $bukuinfo = explode('-', $buku);
                if ($bukuinfo[0] === $kodebuku) {

                    // Unggah gambar baru
                    if (isset($_FILES['cover']) && $_FILES['cover']['error'] === 0) {
                        if (($_FILES['cover']) !== '') {
                            // Menghapus file cover buku jika ada
                            $cover = trim($_POST['existing_cover']);
                            if (!empty($cover)) {
                                $cover_path = 'img/' . $cover;
                                if (file_exists($cover_path)) {
                                    unlink($cover_path);
                                }
                            }

                            $cover = $_FILES['cover']['name'];
                            $cover_tmp = $_FILES['cover']['tmp_name'];
                            move_uploaded_file($cover_tmp, 'img/' . $cover);
                            $buku = $kodebuku . '-' . $judul . '-' . $pengarang . '-' . $penerbit . '-' . $tahunterbit . '-' . $cover . PHP_EOL;
                        } else {
                            $cover = $_POST['existing_cover'];
                            $buku = $kodebuku . '-' . $judul . '-' . $pengarang . '-' . $penerbit . '-' . $tahunterbit . '-' . $cover;
                        }
                    } else {
                        $cover = $_POST['existing_cover'];
                        $buku = $kodebuku . '-' . $judul . '-' . $pengarang . '-' . $penerbit . '-' . $tahunterbit . '-' . $cover;
                    }
                }
                $output .= $buku;
            }
            file_put_contents($file_name, $output);
            header("Location: baca.php");
            exit();
        }
    }
}

?>