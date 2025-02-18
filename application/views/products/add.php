<!DOCTYPE html>
<html>

<head>
    <title>Tambah Produk</title>
    <!-- Tambahkan CDN Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Tambah Produk Baru</h2>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?= validation_errors(); ?>
            </div>
        <?php endif; ?>

        <!-- Form Tambah Produk -->
        <?php echo form_open('products/insert'); ?>

        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name') ?>" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" class="form-control" id="price" name="price" value="<?= set_value('price') ?>" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Jumlah Stok</label>
            <input type="number" class="form-control" id="stock" name="stock" value="<?= set_value('stock') ?>" required>
        </div>

        <div class="mb-3">
            <label for="is_sell" class="form-label">Status Produk</label>
            <select class="form-select" id="is_sell" name="is_sell" required>
                <option value="1" <?= set_select('is_sell', '1') ?>>Dijual</option>
                <option value="0" <?= set_select('is_sell', '0') ?>>Tidak Dijual</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Produk</button>
        <a href="<?= site_url('products') ?>" class="btn btn-secondary">Kembali</a>

        <?php echo form_close(); ?>

    </div>

    <!-- Tambahkan JS Bootstrap (Opsional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
