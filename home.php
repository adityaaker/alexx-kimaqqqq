<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <!-- Total Pelanggan -->
        <div class="col-xl-3 col-md-6">
            <div class="card" style="background-color: #ff4d4d; color: #ffffff; margin-bottom: 1rem;"> <!-- Merah terang -->
                <div class="card-body"><?php echo mysqli_num_rows(mysqli_query($koneksi, "select*from pelanggan")); ?> Total Pelanggan</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    
                </div>
            </div>
        </div>
        <!-- Total Produk -->
        <div class="col-xl-3 col-md-6">
            <div class="card" style="background-color: #4dff4d; color: #ffffff; margin-bottom: 1rem;"> <!-- Hijau terang -->
                <div class="card-body"><?php echo mysqli_num_rows(mysqli_query($koneksi, "select*from produk")); ?> Total Produk</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    
                </div>
            </div>
        </div>
        <!-- Pembelian -->
        <div class="col-xl-3 col-md-6">
            <div class="card" style="background-color: #ffcc00; color: #000000; margin-bottom: 1rem;"> <!-- Kuning terang -->
                <div class="card-body"><?php echo mysqli_num_rows(mysqli_query($koneksi, "select*from penjualan")); ?> Penjualan</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card" style="background-color:rgb(160, 77, 255); color: #ffffff; margin-bottom: 1rem;"> <!-- Merah terang -->
                <div class="card-body"><?php echo mysqli_num_rows(mysqli_query($koneksi, "select*from detail_penjualan")); ?> Total Pelanggan</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    
                </div>
            </div>
        </div>
        <!-- Total User -->
        <div class="col-xl-3 col-md-6">
            <div class="card" style="background-color: #4d4dff; color: #ffffff; margin-bottom: 1rem;"> <!-- Biru terang -->
                <div class="card-body"><?php echo mysqli_num_rows(mysqli_query($koneksi, "select*from user")); ?> Total User</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    
                </div>
            </div>
        </div>
    </div>
</div>
