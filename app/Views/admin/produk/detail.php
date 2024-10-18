<?= $this->extend('admin/layout/template') ?>

<?= $this->Section('content') ?>
<div id="layoutSidenav_content">
<main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $title ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i> Detail Produk : <?= $data_produk ?>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?= $this->endSection(); ?>   