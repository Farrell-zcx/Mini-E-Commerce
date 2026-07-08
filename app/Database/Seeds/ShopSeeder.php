<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ShopSeeder extends Seeder
{
    public function run()
    {
        // Isi Data Kategori 
        $dataKategori = [
            ['nama_kategori' => 'Gadget & Audio', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_kategori' => 'Computer Peripheral', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_kategori' => 'Fragrance', 'created_at' => date('Y-m-d H:i:s')],
        ];
        $this->db->table('kategori')->insertBatch($dataKategori);

        // Ambil ID dari kategori yang baru saja masuk untuk relasi produk
        // Di Postgres, kita asumsikan ID bermula dari 1, 2, dan 3
        $dataProduk = [
            [
                'kategori_id' => 1, // Masuk ke Gadget & Audio
                'nama_produk' => 'Kinera Celest Wyvern Abyss IEM',
                'deskripsi'   => 'In-Ear Monitor dengan kualitas suara jernih, imaging akurat, sangat cocok untuk gaming kompetitif dan dengerin musik hi-res.',
                'harga'       => 450000,
                'stok'        => 15,
                'foto'        => 'wyvern_abyss.png',
                'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'kategori_id' => 2, // Masuk ke Computer Peripheral
                'nama_produk' => 'Aula S75 Pro Mechanical Keyboard',
                'deskripsi'   => 'Keyboard mekanikal 75% layout dengan gasket mount, flex cut PCB, dan sound profile yang super thacky.',
                'harga'       => 650000,
                'stok'        => 8,
                'foto'        => 'aula_s75.png',
                'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'kategori_id' => 3, // Masuk ke Fragrance
                'nama_produk' => 'Afnan Supremacy Collector Edition EDP',
                'deskripsi'   => 'Aroma klon legendaris dengan performa monster, kombinasi nanas segar, bergamot, dan notes smoky yang maskulin.',
                'harga'       => 850000,
                'stok'        => 5,
                'foto'        => 'afnan_sce.png',
                'created_at'  => date('Y-m-d H:i:s')
            ],
        ];
        $this->db->table('produk')->insertBatch($dataProduk);
    }
}