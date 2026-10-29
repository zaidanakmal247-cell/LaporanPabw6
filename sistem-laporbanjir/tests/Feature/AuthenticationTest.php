<?php

use App\Models\User;
use App\Models\Laporan;
use Database\Seeders\PetugasSeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guest is redirected to login when opening the report list', function () {
    $response = $this->get(route('laporan.index'));

    $response->assertRedirect(route('login'));
});

test('home sends guests to login and authenticated users to the report form', function () {
    $this->get('/')->assertRedirect(route('login'));

    $this->actingAs(User::factory()->create())
        ->get('/')
        ->assertRedirect(route('laporan.create'));
});

test('login and registration pages link to each other and authenticated users go to the report form', function () {
    $this->get(route('login'))
        ->assertOk()
        ->assertSee(route('register'))
        ->assertSee('Belum punya akun?')
        ->assertSee('membuat laporan tanpa login')
        ->assertDontSee('Buat Laporan');

    $this->get(route('register'))
        ->assertOk()
        ->assertSee(route('login'))
        ->assertSee('Sudah punya akun?');

    $this->actingAs(User::factory()->create())
        ->get(route('login'))
        ->assertRedirect(route('laporan.create'));

    $this->get(route('register'))
        ->assertRedirect(route('laporan.create'));
});

test('guest can view and submit a report without logging in', function () {
    $this->get(route('laporan.create'))
        ->assertOk()
        ->assertSee('Login')
        ->assertSee('Register')
        ->assertDontSee('Buat Laporan')
        ->assertDontSee('Daftar Laporan');

    $this->post(route('lapor.kirim'), [
        'nama_pelapor' => 'Warga Bandung',
        'lokasi' => 'Dayeuhkolot',
        'tinggi_genangan' => 50,
        'tanggal_kejadian' => '2026-10-29',
    ])->assertRedirect(route('laporan.create'));

    $this->assertDatabaseHas('laporan', [
        'nama_pelapor' => 'Warga Bandung',
        'lokasi' => 'Dayeuhkolot',
    ]);
    $this->assertGuest();
});

test('authenticated staff can view reports saved in the database', function () {
    $user = User::factory()->create();

    Laporan::create([
        'nama_pelapor' => 'Warga Uji Database',
        'lokasi' => 'Baleendah',
        'tinggi_genangan' => 75,
        'tanggal_kejadian' => '2026-10-28',
    ]);

    $this->actingAs($user)
        ->get(route('laporan.index'))
        ->assertOk()
        ->assertSee('Lihat Laporan Banjir Terkini')
        ->assertSee('Warga Uji Database')
        ->assertSee('Baleendah')
        ->assertSee('75');
});

test('staff can register login view their profile and logout', function () {
    $this->post(route('register.store'), [
        'name' => 'Petugas Baru',
        'email' => 'petugas@example.com',
        'password' => 'Rahasia123!',
        'password_confirmation' => 'Rahasia123!',
    ])->assertRedirect(route('laporan.create'));

    $this->assertAuthenticated();
    $user = User::where('email', 'petugas@example.com')->firstOrFail();
    $this->assertTrue(Hash::check('Rahasia123!', $user->password));

    $this->get(route('petugas.profile'))
        ->assertOk()
        ->assertSee('Petugas Baru')
        ->assertSee('petugas@example.com')
        ->assertSee($user->created_at->format('d-m-Y H:i:s'))
        ->assertSee('Daftar Laporan')
        ->assertSee('Logout');

    $this->post(route('logout'))->assertRedirect(route('login'));
    $this->assertGuest();
});

test('staff can log in with valid credentials', function () {
    $user = User::factory()->create(['password' => Hash::make('Rahasia123!')]);

    $this->post(route('login.store'), [
        'email' => $user->email,
        'password' => 'Rahasia123!',
    ])->assertRedirect(route('laporan.create'));

    $this->assertAuthenticatedAs($user);
});

test('admin account created by the staff seeder can log in', function () {
    $this->seed(PetugasSeeder::class);

    $this->assertSame(5, User::where('email', 'like', 'petugas%@bpbd-bandung.go.id')->count());
    $petugasPassword = User::where('email', 'petugas1@bpbd-bandung.go.id')->value('password');
    $this->assertTrue(Hash::check('Petugas123!', $petugasPassword));

    $this->post(route('login.store'), [
        'email' => 'admin@bpbd-bandung.go.id',
        'password' => 'AdminBPBD123!',
    ])->assertRedirect(route('laporan.create'));

    $this->assertAuthenticatedAs(User::where('email', 'admin@bpbd-bandung.go.id')->first());
});

test('invalid registration and login inputs are rejected', function () {
    $this->post(route('register.store'), [
        'name' => '',
        'email' => 'bukan-email',
        'password' => 'singkat',
        'password_confirmation' => 'berbeda',
    ])->assertSessionHasErrors(['name', 'email', 'password']);

    $this->post(route('login.store'), [
        'email' => 'petugas@example.com',
        'password' => 'salah',
    ])->assertSessionHasErrors('email');
});
