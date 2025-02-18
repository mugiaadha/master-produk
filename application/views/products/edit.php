<!DOCTYPE html>
<html>

<head>
    <title>Edit Produk</title>
    <!-- Tambahkan CDN Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Produk</h2>

        <!-- Form Edit Produk -->
        <?php echo form_open('products/update/' . $product->id); ?>

        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name"
                value="<?= htmlspecialchars($product->name) ?>" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" class="form-control" id="price" name="price" value="<?= $product->price ?>" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Jumlah Stok</label>
            <input type="number" class="form-control" id="stock" name="stock" value="<?= $product->stock ?>" required>
        </div>

        <div class="mb-3">
            <label for="is_sell" class="form-label">Status Produk</label>
            <select class="form-select" id="is_sell" name="is_sell" required>
                <option value="1" <?= ($product->is_sell == 1) ? 'selected' : '' ?>>Dijual</option>
                <option value="0" <?= ($product->is_sell == 0) ? 'selected' : '' ?>>Tidak Dijual</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="<?= site_url('products') ?>" class="btn btn-secondary">Kembali</a>

        <?php echo form_close(); ?>

    </div>

    <!-- Tambahkan JS Bootstrap (Opsional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>