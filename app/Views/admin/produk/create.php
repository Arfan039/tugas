<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
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
                            <i class="fas fa-table me-1"></i> Tambah Produk
                        </div>
                        <div class="card-body">

                            <?php if (session('success')) : ?>
                                <div class="alert alert-success">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (session('failed')) : ?>
                                <div class="alert alert-danger">
                                    <?= session('failed'); ?>
                                </div>
                            <?php endif; ?>

                            <form action="<?= base_url('daftar-produk/create-produk'); ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>

                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="nama_produk">Nama Produk</label>
                                        <input type="text" name="nama_produk" id="nama_produk" class="form-control <?= $validation->hasError('nama_produk') ? 'is-invalid' : null ?>" value="<?= old('nama_produk') ?>">

                                        <?php if($validation->hasError('nama_produk')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('nama_produk'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="kategori_slug">Kategori Produk</label>
                                        <select name="kategori_slug" id="kategori_slug" class="form-control <?= $validation->hasError('kategori_slug') ? 'is-invalid' : null ?>">
                                            <option value="" hidden>-- Pilih --</option>
                                            <?php foreach($kategori_produk as $kategori) : ?>
                                                <option value="<?= $kategori->slug_kategori; ?>" <?= old('kategori_slug') == $kategori->slug_kategori ? 'selected' : '' ?>><?= $kategori->nama_kategori; ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <?php if($validation->hasError('kategori_slug')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('kategori_slug'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-3">
                                        <label for="deskripsi">Deskripsi Produk</label>
                                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control <?= $validation->hasError('deskripsi') ? 'is-invalid' : null ?>"><?= old('deskripsi') ?></textarea>

                                        <?php if($validation->hasError('deskripsi')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('deskripsi'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-3">
                                        <label for="gambar_produk">Gambar Produk</label>
                                        <input type="file" name="gambar_produk" id="gambar_produk" class="form-control <?= $validation->hasError('gambar_produk') ? 'is-invalid' : null ?>" onchange="previewImg()">

                                        <?php if($validation->hasError('gambar_produk')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('gambar_produk'); ?>
                                            </div>
                                        <?php endif; ?>

                                        <img src="" alt="" class="preview-img" width="100px">
                                    </div>

                                    <div class="justify-content-end d-flex">
                                        <button class="btn btn-primary btn-sm">Tambah Coy</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?= $this->endSection(); ?>   

<?= $this->section('script'); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#deskripsi'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });

    function previewImg() {
        const gambar = document.querySelector('#gambar_produk');
        const imgPreview = document.querySelector('.preview-img');

        const fileGambar = new FileReader();
        fileGambar.readAsDataURL(gambar.files[0]);

        fileGambar.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
<?= $this->endSection(); ?>
