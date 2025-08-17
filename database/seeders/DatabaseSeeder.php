<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Proyek;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'username' => 'pengawas',
            'email' => 'ahimsyahmr@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'pengawas',
            'whatsapp' => '6281318088048',
            'file_path' => 'path/to/file.pdf',
            'status' => 'non-active',
        ]);
        User::factory()->create([
            'name' => 'Admin User',
            'username' => 'adminuser',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'whatsapp' => '6287845712433',
            'file_path' => 'path/to/file.pdf',
            'status' => 'active',
        ]);
        User::factory()->create([
            'name' => 'Tender User',
            'username' => 'tender',
            'email' => 'tender@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'tender',
            'whatsapp' => '6281339303763',
            'file_path' => 'path/to/file.pdf',
            'status' => 'active',
        ]);

        Proyek::factory()->create([
            'user_id' => 1, // Assuming the first user is the owner of this project
            'tender_id' => 3, // Assuming this project is associated with a tender
            'nameProyek' => 'Proyek A',
            'lokasi' => 'Lokasi A',
            'jenis' => 'Jenis A',
            'nilai' => '1000000',
            'gambar' => 'gambar_a.jpg',
            'file_path' => 'path/to/proyek_a.pdf',
            'status' => 'non-active',
        ]);
        Proyek::factory()->create([
            'user_id' => 2, // Assuming this project is not owned by any user
            'tender_id' => 3, // Assuming this project is associated with a tender
            'nameProyek' => 'Proyek B',
            'lokasi' => 'Lokasi B',
            'jenis' => 'Jenis B',
            'nilai' => '2000000',
            'gambar' => 'gambar_b.jpg',
            'file_path' => 'path/to/proyek_b.pdf',
            'status' => 'active',
        ]);
    }

}
