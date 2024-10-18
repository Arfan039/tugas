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
                            <i class="fas fa-table me-1"></i> Daftar Produk
                        </div>
                        <div class="card-body">
                            <a href="<?= base_url('daftar-produk/tambah'); ?>" class="btn btn-primary btn-sm mb-2">
                                <i class="fas fa-plus"></i> Tambah
                            </a>

                            <?php if (session('success')) : ?>
                                <div class="alert alert-success">
                                    <?= session('success'); ?>
                                </div>
                            <?php endif; ?>

                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>produk</th>
                                        <th>Tanggal Input</th>
                                        <th>Fungsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_produk as $produk) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $produk->nama_produk; ?></td>
                                            <td><?= $produk->kategori_slug; ?></td>
                                            <td><?= date('d/m/Y H:i:s', strtotime($produk->tanggal_input)); ?></td>
                                            <td width="20%" class="text-center">
                                                <a href="" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i> Detail</a>
                                                <a href="<?= base_url('daftar-produk/ubah/'). $produk->id_produk ?>" class="btn btn-success btn-sm">
                                                    <i class="fas fa-edit"></i> Ubah
                                                </a>
                                                <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $produk->id_produk; ?>">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

     <!-- Modal P -->
     <?php foreach ($daftar_produk as $produk) : ?>
        <div class="modal fade" id="hapusModal<?= $produk->id_produk; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-trash-alt"></i> Hapus Data Produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="<?= base_url('daftar-produk/hapus-produk/' . $produk->id_produk) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <p>Yakin ingin menghapus Produk Ini: <strong><?= $produk->nama_produk; ?></strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?= $this->endSection(); ?>   