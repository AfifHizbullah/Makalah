<?php

namespace Tests\Feature;

use App\Models\Makalah;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MakalahTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to see if makalah index page loads correctly.
     *
     * @return void
     */

    /**
     * Test to access the create page.
     *
     * @return void
     */
    public function test_makalah_create_page()
    {
        // Membuat pengguna dan login
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('makalahs.create'));
        $response->assertStatus(200); // Pastikan halaman dapat diakses
        $response->assertViewIs('makalahs.create'); // Pastikan tampilan yang benar
    }

    /**
     * Test to store a new makalah.
     *
     * @return void
     */
    public function test_store_new_makalah()
    {
        // Membuat pengguna dan login
        $user = User::factory()->create();

        $data = [
            'Judul_Artikel' => 'Artikel Baru',
            'Penulis' => 'John Doe',
            'Nama_Seminar' => 'Seminar Teknologi',
            'Penyelenggara_Seminar' => 'Tech Inc.',
            'Waktu_Pelaksaaan' => '2024-12-01',
            'URL' => 'https://example.com'
        ];

        $response = $this->actingAs($user)->post(route('makalahs.store'), $data);
        $response->assertRedirect(route('makalahs.index')); // Pastikan setelah penyimpanan diarahkan ke halaman index
        $response->assertSessionHas('success'); // Pastikan ada session success

        // Cek apakah data berhasil disimpan di database
        $this->assertDatabaseHas('makalahs', [
            'Judul_Artikel' => 'Artikel Baru',
            'Penulis' => 'John Doe',
            'Nama_Seminar' => 'Seminar Teknologi',
        ]);
    }

    /**
     * Test to show a specific makalah.
     *
     * @return void
     */
    public function test_show_makalah()
    {
        // Membuat pengguna dan login
        $user = User::factory()->create();
        
        $makalah = Makalah::factory()->create(); // Buat makalah menggunakan factory

        $response = $this->actingAs($user)->get(route('makalahs.show', $makalah->id));
        $response->assertStatus(200); // Pastikan halaman dapat diakses
        $response->assertViewHas('makalahs'); // Pastikan data makalahs ada di view
    }

    /**
     * Test to access the edit page.
     *
     * @return void
     */
    public function test_makalah_edit_page()
    {
        // Membuat pengguna dan login
        $user = User::factory()->create();
        
        $makalah = Makalah::factory()->create(); // Buat makalah untuk diedit

        $response = $this->actingAs($user)->get(route('makalahs.edit', $makalah->id));
        $response->assertStatus(200); // Pastikan halaman dapat diakses
        $response->assertViewIs('makalahs.edit'); // Pastikan tampilan yang benar
    }

    /**
     * Test to update a makalah.
     *
     * @return void
     */
    public function test_update_makalah()
    {
        // Membuat pengguna dan login
        $user = User::factory()->create();
        
        $makalah = Makalah::factory()->create(); // Buat makalah yang akan diupdate

        $data = [
            'Judul_Artikel' => 'Artikel Diperbarui',
            'Penulis' => 'Jane Doe',
            'Nama_Seminar' => 'Seminar Teknologi Lanjutan',
            'Penyelenggara_Seminar' => 'Tech Corp.',
            'Waktu_Pelaksaaan' => '2024-12-02',
            'URL' => 'https://updated-example.com'
        ];

        $response = $this->actingAs($user)->put(route('makalahs.update', $makalah->id), $data);
        $response->assertRedirect(route('makalahs.show', $makalah->id)); // Pastikan diarahkan ke halaman show
        $response->assertSessionHas('success'); // Pastikan ada session success

        // Cek apakah data berhasil diperbarui di database
        $this->assertDatabaseHas('makalahs', [
            'Judul_Artikel' => 'Artikel Diperbarui',
            'Penulis' => 'Jane Doe',
        ]);
    }

    /**
     * Test to delete a makalah.
     *
     * @return void
     */
    public function test_delete_makalah()
    {
        // Membuat pengguna dan login
        $user = User::factory()->create();
        
        $makalah = Makalah::factory()->create(); // Buat makalah untuk dihapus

        $response = $this->actingAs($user)->delete(route('makalahs.destroy', $makalah->id));
        $response->assertRedirect(route('makalahs.index')); // Pastikan diarahkan ke halaman index
        $response->assertSessionHas('success'); // Pastikan ada session success

        // Pastikan data makalah sudah tidak ada di database
        $this->assertDatabaseMissing('makalahs', [
            'id' => $makalah->id
        ]);
    }
}
