<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table            = 'kategori_produk';
    protected $primaryKey       = 'id_kategori';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama_kategori','slug_kategori' ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tanggal_input';
    protected $updatedField  = 'tanggal_ubah';

}
