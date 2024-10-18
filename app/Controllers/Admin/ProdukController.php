<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\KategoriModel;

class ProdukController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Produk',
            'daftar_produk' => $this->ProdukModel->orderby('id_produk', 'DESC')->findAll()

        ];
        return view('admin/produk/index', $data);
    }
    public function form_create()
    {
        $data = [
            'title' => 'Tambah Produk',
            'kategori_produk' => $this->KategoriModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/produk/create', $data);
    }

    public function form_update($id_produk)
    {
        $data = [
            'title' => 'Ubah Produk',
            'data_produk' => $this->ProdukModel->find($id_produk),
            'kategori_produk' => $this->KategoriModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/produk/update', $data);
    }

    public function create_produk()
    {
        $rules = $this->validate([
            'nama_produk'   => 'required',
            'kategori_slug' => 'required',
            'deskripsi'     => 'required',
            'gambar_produk' => 'max_size[gambar_produk,2848]|uploaded[gambar_produk]|is_image[gambar_produk]|mime_in[gambar_produk,image/png,image/jpg,image/jpeg]'
       ]);

        if(!$rules) {
            session()->setFlashdata('failed', 'Data Produk Gagal Ditambah');
            return redirect()->back()->withInput();
        }

        $slug_produk = url_title($this->request->getPost('nama_produk'), '-', TRUE);

        $gambar = $this->request->getFile('gambar_produk');

        $namaGambar = $gambar->getRandomName();

        $gambar->move(WRITEPATH. '../public//asset-admin/img', $namaGambar);

        $this->ProdukModel->insert([
            'slug)_produk'  => $slug_produk,
            'nama_produk'   => esc($this->request->getPost('nama_produk')),
            'kategori_slug' => esc($this->request->getPost('kategori_slug')),
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'gambar_produk' => $namaGambar
        ]);

        return redirect()->to(base_url('daftar-produk'))->with('success', 'Data Produk Berhasil Ditambah');
    }

    public function update_produk($id_produk)
    {
        if (!$this->validate([
            'nama_produk'   => 'required',
            'kategori_slug' => 'required',
            'deskripsi'     => 'required',
            'gambar_produk' => 'max_size[gambar_produk,2848]|is_image[gambar_produk]|mime_in[gambar_produk,image/png,image/jpg,image/jpeg]'
        ])) {
            session()->setFlashdata('failed', 'Data Produk Gagal Diupdate');
            return redirect()->back()->withInput();
        }

        $slug_produk = url_title($this->request->getPost('nama_produk'), '-', TRUE);
        $gambar = $this->request->getFile('gambar_produk');

        if ($gambar && $gambar->isValid()) {
            $namaGambar = $gambar->getRandomName();
            $gambar->move(WRITEPATH . '../public/asset-admin/img', $namaGambar);
        } else {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $namaGambar = $this->request->getPost('gambarLama');
        }

        $this->ProdukModel->update($id_produk, [
            'slug_produk'   => $slug_produk,
            'nama_produk'   => esc($this->request->getPost('nama_produk')),
            'kategori_slug' => esc($this->request->getPost('kategori_slug')),
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'gambar_produk' => $namaGambar
        ]);

        return redirect()->to(base_url('daftar-produk'))->with('success', 'Data Produk Berhasil Diupdate');
    }
    public function delete_produk($id_produk)
{
    // Temukan produk berdasarkan ID
    $produk = $this->ProdukModel->find($id_produk);

    // Pastikan produk ditemukan
    if (!$produk) {
        return redirect()->back()->with('failed', 'Produk tidak ditemukan');
    }

    // Cek dan hapus gambar jika ada
    $gambarPath = WRITEPATH . '../public/asset-admin/img/' . $produk->gambar_produk;

    // Hapus data produk dari database
    $this->ProdukModel->delete($id_produk);

    return redirect()->back()->with('success', 'Data Berhasil Dihapus');
}
    public function detail_produk($id_produk)
    {
        $data = [
            'title' => 'Detail Produk',
            'data_produk' => $this->ProdukModel->find($id_produk)
        ];
    }


    //function Kategori
    public function kategori() 
    {
        $data = [
            'title' => 'Daftar Kategori',
            'daftar_kategori' => $this->KategoriModel->orderBy('id_kategori', 'DESC')->findAll(),
        ];
        return view('admin/produk/kategori', $data);
    }
    public function store() 
    {
        $slug = url_title($this->request->getPost('nama_kategori'),'-',true); 

        $data = [
            'nama_kategori' => esc($this->request->getPost('nama_kategori')),
            'slug_kategori' => $slug
        ];
        
        $this->KategoriModel->insert($data);

        return redirect()->back()->with('success', 'Data Kategori Produk Berhasil Ditambahkan');
    }
    public function update($id_kategori) 
    {
        $slug = url_title($this->request->getPost('nama_kategori'),'-',true); 

        $data = [
            'nama_kategori' => esc($this->request->getPost('nama_kategori')),
            'slug_kategori' => $slug
        ];
        
        $this->KategoriModel->update($id_kategori, $data);

        return redirect()->back()->with('success', 'Data Kategori Produk Berhasil Ditubah');
    }
        public function hapus($id_kategori)
    {
        if (!$this->KategoriModel->find($id_kategori)) {
            return redirect()-> to('/daftar-kategori')->with('error', 'Kategori tidak ditemukan.');
        }

        if ($this->KategoriModel->delete($id_kategori)) {
            return redirect()->to('/daftar-kategori')->with('success', 'Data Kategori Produk Berhasil Dihapuskan');
        } else {
            return redirect()->to('/daftar-kategori')->with('error', 'Gagal menghapus kategori.');
        }
    }
    



}
