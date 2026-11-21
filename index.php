
<?php
include("koneksi.php");

// Query untuk menampilkan data
$sql = "SELECT * FROM data_barang";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="container">
    <h1>Data Barang</h1>

    <div class="main">
        <p>
            <a href="tambah.php">Tambah Barang</a>
        </p>

        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>Gambar</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>

            <?php if ($result): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td>
                        <img src="<?= htmlspecialchars($row['gambar']); ?>"
                             alt="<?= htmlspecialchars($row['nama']); ?>"
                             width="80">
                    </td>

                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['kategori']); ?></td>
                    <td><?= number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                    <td><?= number_format($row['harga_beli'], 0, ',', '.'); ?></td>
                    <td><?= htmlspecialchars($row['stok']); ?></td>

                    <td>
                        <a href="ubah.php?id=<?= $row['id_barang']; ?>">Ubah</a> |
                        <a href="hapus.php?id=<?= $row['id_barang']; ?>"
                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                           Hapus
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>

            <?php else: ?>
                <tr>
                    <td colspan="7">Belum ada data</td>
                </tr>
            <?php endif; ?>

        </table>
    </div>
</div>

</body>
</html>
