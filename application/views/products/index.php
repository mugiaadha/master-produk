<!DOCTYPE html>
<html>

<head>
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Daftar Produk</h2>

        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah Stok</th>
                    <th>Status Produk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $key => $product): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= htmlspecialchars($product->name) ?></td>
                            <td>Rp <?= number_format($product->price, 2, ',', '.') ?></td>
                            <td><?= $product->stock ?></td>
                            <td>
                                <?= ($product->is_sell == 1) ? 'Dijual' : 'Tidak Dijual' ?>
                            </td>
                            <td>
                                <a href="<?= site_url('products/edit/' . $product->id) ?>"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <a href="<?= site_url('products/delete/' . $product->id) ?>"
                                    class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada produk tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>