<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kategori_id', 'nama_produk', 'deskripsi', 'harga', 'stok', 'foto'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'kategori_id' => 'required|integer',
        'nama_produk' => 'required|min_length[3]|max_length[255]',
        'harga'       => 'required|numeric|greater_than[0]',
        'stok'        => 'required|integer|greater_than_equal_to[0]',
    ];

    protected $validationMessages = [
        'kategori_id' => [
            'required' => 'Kategori produk wajib dipilih.',
            'integer'  => 'Kategori produk tidak valid.',
        ],
        'nama_produk' => [
            'required'   => 'Nama produk wajib diisi.',
            'min_length' => 'Nama produk minimal 3 karakter.',
            'max_length' => 'Nama produk maksimal 255 karakter.',
        ],
        'harga' => [
            'required'     => 'Harga produk wajib diisi.',
            'numeric'      => 'Harga harus berupa angka.',
            'greater_than' => 'Harga harus lebih dari 0.',
        ],
        'stok' => [
            'required'               => 'Jumlah stok wajib diisi.',
            'integer'                => 'Stok harus berupa bilangan bulat.',
            'greater_than_equal_to'  => 'Stok tidak boleh negatif.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Mengambil semua produk beserta nama kategorinya via JOIN.
     *
     * @return array
     */
    public function getProdukWithKategori(): array
    {
        return $this->select('produk.*, kategori.nama_kategori')
                    ->join('kategori', 'kategori.id = produk.kategori_id')
                    ->findAll();
    }
}
