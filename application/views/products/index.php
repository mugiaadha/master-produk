<!DOCTYPE html>
<html>

<head>
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
            <div class="col-6">
                <a href="<?= site_url('products/add') ?>" class="btn btn-success">Tambah Produk</a>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <form action="<?= site_url('products') ?>" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari produk..."
                        value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>
        </div>

        <table class="table table-bordered table-striped table-hover" id="productTable">
            <thead class="table-default">
                <tr>
                    <th>#</th>
                    <th>
                        <a href="javascript:;" id="sortName" data-sort="asc"
                            style="text-decoration: none; color:black;">
                            Nama Produk <i class="fas fa-sort"></i>
                        </a>
                    </th>
                    <th>
                        <a href="javascript:;" id="sortPrice" data-sort="asc"
                            style="text-decoration: none; color:black;">
                            Harga <i class="fas fa-sort"></i>
                        </a>
                    </th>
                    <th>
                        <a href="javascript:;" id="sortStock" data-sort="asc"
                            style="text-decoration: none; color:black;">
                            Jumlah Stok <i class="fas fa-sort"></i>
                        </a>
                    </th>
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
                                <!-- Status Produk dengan radio button -->
                                <form id="status-form-<?= $product->id ?>" action="<?= site_url('products/update_status/' . $product->id) ?>" method="POST">
                                    <input id="is-sell-<?= $product->id ?>" data-id="<?= $product->id ?>" type="radio" class="status-radio" name="status" value="1" <?= ($product->is_sell == 1) ? 'checked' : ''; ?>>
                                    <label for="is-sell-<?= $product->id ?>">Dijual</label>
                                    <input id="is-not-sell-<?= $product->id ?>"id="is-sell-<?= $product->id ?>" data-id="<?= $product->id ?>" type="radio" class="status-radio" name="status" value="0" <?= ($product->is_sell == 0) ? 'checked' : ''; ?>>
                                    <label for="is-not-sell-<?= $product->id ?>">Tidak Dijual</label>
                                    <button type="submit" class="btn btn-sm btn-primary mt-1" hidden>Update</button>
                                </form>
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
    <script>
        $(document).ready(function () {
            // Fungsi untuk mengubah ikon sortir
            function toggleSortIcon(columnId, order) {
                $('th i').removeClass('fa-sort-up fa-sort-down');
                if (order === 'asc') {
                    $(`#${columnId} i`).addClass('fa-sort-up');
                } else {
                    $(`#${columnId} i`).addClass('fa-sort-down');
                }
            }

            $('#sortName').on('click', function (e) {
                e.preventDefault();
                let rows = $('#productTable tbody tr').get();
                let order = $(this).data('sort') === 'asc' ? 'desc' : 'asc';
                rows.sort(function (a, b) {
                    let nameA = $(a).find('td').eq(1).text().toUpperCase();
                    let nameB = $(b).find('td').eq(1).text().toUpperCase();
                    if (order === 'asc') {
                        return nameA > nameB ? 1 : (nameA < nameB ? -1 : 0);
                    } else {
                        return nameA < nameB ? 1 : (nameA > nameB ? -1 : 0);
                    }
                });
                $.each(rows, function (index, row) {
                    $('#productTable tbody').append(row);
                });
                $(this).data('sort', order);
                toggleSortIcon('sortName', order);
            });

            $('#sortPrice').on('click', function (e) {
                e.preventDefault();
                let rows = $('#productTable tbody tr').get();
                let order = $(this).data('sort') === 'asc' ? 'desc' : 'asc';
                rows.sort(function (a, b) {
                    let priceA = parseInt($(a).find('td').eq(2).text().replace(/[^\d]/g, ''));
                    let priceB = parseInt($(b).find('td').eq(2).text().replace(/[^\d]/g, ''));
                    if (order === 'asc') {
                        return priceA - priceB;
                    } else {
                        return priceB - priceA;
                    }
                });
                $.each(rows, function (index, row) {
                    $('#productTable tbody').append(row);
                });
                $(this).data('sort', order);
                toggleSortIcon('sortPrice', order);
            });

            $('#sortStock').on('click', function (e) {
                e.preventDefault();
                let rows = $('#productTable tbody tr').get();
                let order = $(this).data('sort') === 'asc' ? 'desc' : 'asc';
                rows.sort(function (a, b) {
                    let stockA = parseInt($(a).find('td').eq(3).text());
                    let stockB = parseInt($(b).find('td').eq(3).text());
                    if (order === 'asc') {
                        return stockA - stockB;
                    } else {
                        return stockB - stockA;
                    }
                });
                $.each(rows, function (index, row) {
                    $('#productTable tbody').append(row);
                });
                $(this).data('sort', order);
                toggleSortIcon('sortStock', order);
            });

            $('.status-radio').on('change', function () {
                const productId = $(this).data('id'); // Mendapatkan ID produk
                $(`#status-form-${productId}`).submit(); // Submit form terkait produk
            });
        });
    </script>
</body>

</html>