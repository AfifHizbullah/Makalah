<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test login page loads correctly.
     *
     * @return void
     */
    public function test_login_page_is_accessible()
    {
        $response = $this->get('/login');
        $response->assertStatus(200); // Pastikan halaman login dapat diakses
        $response->assertSee('Login'); // Pastikan kata "Login" ada di halaman
    }

    /**
     * Test successful login with valid credentials.
     *
     * @return void
     */
    public function test_successful_login()
    {
        // Menggunakan factory untuk membuat user dengan password terenkripsi
        $user = User::factory()->create([
            'email' => 'johndoe@example.com',
            'password' => Hash::make('password123'), // Gunakan Hash::make() untuk konsistensi
        ]);

        // Mengirimkan data login yang valid
        $response = $this->post('/login', [
            'email' => 'johndoe@example.com',
            'password' => 'password123',
        ]);

        // Verifikasi pengguna berhasil login dan diarahkan ke dashboard
        $response->assertRedirect(route('dashboard')); // Pengalihan setelah login sukses
        $this->assertAuthenticatedAs($user); // Verifikasi bahwa pengguna yang login adalah pengguna yang sesuai
    }

    /**
     * Test login failure with invalid email.
     *
     * @return void
     */
    public function test_login_failure_due_to_invalid_email()
    {
        // Mengirimkan data login dengan email yang tidak terdaftar
        $response = $this->post('/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'password123',
        ]);

        // Verifikasi bahwa kesalahan untuk email ditampilkan
        $response->assertSessionHasErrors(['email']);
    }

    /**
     * Test login failure due to incorrect password.
     *
     * @return void
     */
    public function test_login_failure_due_to_incorrect_password()
    {
        // Menggunakan factory untuk membuat user dengan password terenkripsi
        $user = User::factory()->create([
            'email' => 'johndoe@example.com',
            'password' => Hash::make('password123'), // Gunakan Hash::make() untuk konsistensi
        ]);

        // Mengirimkan data login dengan kata sandi yang salah
        $response = $this->post('/login', [
            'email' => 'johndoe@example.com',
            'password' => 'wrongpassword',
        ]);

        // Verifikasi bahwa kesalahan untuk password ditampilkan
        $response->assertSessionHasErrors(['password']);
    }

    /**
     * Test login failure due to missing fields.
     *
     * @return void
     */
    public function test_login_failure_due_to_missing_fields()
    {
        // Mengirimkan data login yang tidak lengkap
        $response = $this->post('/login', [
            'email' => '',
            'password' => '',
        ]);

        // Verifikasi bahwa kesalahan validasi ditampilkan untuk email dan password
        $response->assertSessionHasErrors(['email', 'password']);
    }
}
