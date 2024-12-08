<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Menguji halaman registrasi dapat dimuat dengan benar
     *
     * @return void
     */
    public function test_register_page_is_accessible()
    {
        // Mengunjungi halaman register
        $response = $this->get(route('register'));

        // Memastikan halaman dapat dimuat dengan status 200
        $response->assertStatus(200);
        $response->assertSee('Register'); // Memastikan halaman mengandung kata "Register"
    }

    /**
     * Menguji validasi form registrasi
     *
     * @return void
     */
    public function test_register_validation()
    {
        // Mengirimkan data yang tidak valid (misalnya, tanpa nama)
        $response = $this->post(route('register'), [
            'name' => '', // Nama kosong
            'email' => 'invalid-email',
            'password' => 'short',
            'password_confirmation' => 'notmatching',
        ]);

        // Memastikan bahwa form tidak diterima dan kembali dengan error
        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    /**
     * Menguji registrasi pengguna berhasil
     *
     * @return void
     */
    public function test_user_can_register()
    {
        // Mengirimkan data yang valid untuk registrasi
        $response = $this->post(route('register'), [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Memastikan pengguna berhasil terdaftar dan diarahkan ke halaman login
        $response->assertRedirect(route('login')); // Pastikan diarahkan ke login
        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com',
        ]); // Memastikan pengguna baru ada di database
    }

    /**
     * Menguji jika registrasi dengan email yang sudah terdaftar gagal
     *
     * @return void
     */
    public function test_register_with_duplicate_email()
    {
        // Membuat pengguna dengan email yang sama
        User::create([
            'name' => 'Existing User',
            'email' => 'existinguser@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Mengirimkan data dengan email yang sudah ada
        $response = $this->post(route('register'), [
            'name' => 'Another User',
            'email' => 'existinguser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Memastikan bahwa pendaftaran gagal dan error ditampilkan untuk email
        $response->assertSessionHasErrors('email');
    }
}
