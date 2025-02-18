<!DOCTYPE html>
<html>

<head>
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Daftar Produk</h2>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php elseif ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        <div class="row mb-4">
            <!-- Form Filter Search di Kiri -->
            <div class="col-6">
                <a href="<?= site_url('products/add') ?>" class="btn btn-success">Tambah Produk</a>
            </div>

            <!-- Tombol Tambah Produk di Kanan -->
            <div class="col-6 d-flex justify-content-end">
                <form action="<?= site_url('products') ?>" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari produk..." value="<?= $_GET['search']; ?>">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>
        </div>

        <table class="table table-bordered table-striped table-hover">
            <thead class="table-default">
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