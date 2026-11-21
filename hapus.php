
<?php
include "koneksi.php";

// Mengambil ID barang dari URL
if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    // Menghapus data berdasarkan ID
    $sql = "DELETE FROM data_barang WHERE id_barang = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Data gagal dihapus: " . mysqli_error($conn);
    }

} else {
    echo "ID barang tidak ditemukan.";
}
?>
