
<?php
include "koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM data_barang WHERE id_barang='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data barang tidak ditemukan.");
}

if (isset($_POST['submit'])) {

    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];

    $gambar = $data['gambar'];

    if (isset($_FILES['file_gambar']) &&
        $_FILES['file_gambar']['error'] == 0) {

        $filename = basename($_FILES['file_gambar']['name']);
        $destination = __DIR__ . "/gambar/" . $filename;

        if (move_uploaded_file(
            $_FILES['file_gambar']['tmp_name'],
            $destination
        )) {
            $gambar = "gambar/" . $filename;
        }
    }

    $sql = "UPDATE data_barang SET
            nama=?,
            kategori=?,
            harga_jual=?,
            harga_beli=?,
            stok=?,
            gambar=?
            WHERE id_barang=?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssddisi",
        $nama,
        $kategori,
        $harga_jual,
        $harga_beli,
        $stok,
        $gambar,
        $id
    );

    mysqli_stmt_execute($stmt);

    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Data Barang</title>
</head>

<body>

<h1>Ubah Data Barang</h1>

<form method="post" enctype="multipart/form-data">

    <p>
        Nama Barang:
        <input type="text" name="nama"
        value="<?= htmlspecialchars($data['nama']); ?>" required>
    </p>

    <p>
        Kategori:
        <select name="kategori">
            <?php
            $kategori = ["Komputer", "Elektronik", "Hand Phone"];

            foreach ($kategori as $k) {
                $selected = ($data['kategori'] == $k)
                    ? "selected" : "";

                echo "<option value='$k' $selected>$k</option>";
            }
            ?>
        </select>
    </p>

    <p>
        Harga Jual:
        <input type="number" name="harga_jual"
        value="<?= $data['harga_jual']; ?>" required>
    </p>

    <p>
        Harga Beli:
        <input type="number" name="harga_beli"
        value="<?= $data['harga_beli']; ?>" required>
    </p>

    <p>
        Stok:
        <input type="number" name="stok"
        value="<?= $data['stok']; ?>" required>
    </p>

    <p>
        Gambar:
        <input type="file" name="file_gambar" accept="image/*">
    </p>

    <p>
        <input type="submit" name="submit" value="Simpan Perubahan">
    </p>

</form>

<a href="index.php">Kembali</a>

</body>
</html>
