<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        // Membuat struktur kolom untuk tabel 'users'
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_lengkap' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255, // Panjang 255 wajib untuk menampung hash password aman
            ],
            'role' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'customer', // Default akun baru mendaftar sebagai pembeli
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // Menentukan Primary Key
        $this->forge->addKey('id', true);

        // Menentukan Unique Key agar satu email tidak bisa didaftarkan berkali-kali
        $this->forge->addUniqueKey('email');

        // Perintah eksekusi pembuatan tabel 'users'
        $this->forge->createTable('users');
    }

    public function down()
    {
        // Perintah untuk menghapus tabel jika migrasi di-rollback
        $this->forge->dropTable('users');
    }
}