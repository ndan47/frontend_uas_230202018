## 1. Membuat Project Laravel

Untuk membuat project Laravel baru, jalankan perintah berikut: (pada command prompt jangan di terminal visual studio code)

```
laravel new example-app
```
nama file example-app bisa diganti sesuai keinginan.

## 2. Buka Project di Visual Studio Code

Pindah ke direktori project frontend dan buka dengan VS Code
```
cd eval_pbf_frontend_latihan
code .
```

## 3. Install NPM dan Build
Masuk ke folder project Laravel:

```
cd example-app
npm install
npm run build
composer run dev
```

## 4. Ubah Konfigurasi .env

```
SESSION_DRIVER=file
(nama filenya)
```
## 5. Tambahkan Konfigurasi 
API ke config/services.php
```
'api' => [
    'api_base_url' => env('API_BASE_URL'),
],
```
## 6. Buat Controller Melalui Terminal
Gunakan Artisan(untuk FE) untuk membuat controller Mahasiswa dan Dosen, jika php Spark serve (untuk BE)

```
php artisan make:controller MahasiswaController
php artisan make:controller DosenController
``` 
##7. Tambahkan Fungsi index di MahasiswaController

Edit file app/Http/Controllers/MahasiswaController.php, dan tambahkan
```
use Illuminate\Support\Facades\Http;

public function index() {
    $response = Http::get(config('services.api.api_base_url') . '/mahasiswa');
    return view('mahasiswa.index', [
        'mahasiswa' => $response->json()
    ]);
}
```
## 8. Buat View untuk Menampilkan Data Mahasiswa
Buat folder dan file view
```
resources/views/mahasiswa/index.blade.php
@dd($mahasiswa)
```

## 9. Tambahkan Routes Web
Edit file routes/web.php
```
use App\Http\Controllers\MahasiswaController;
Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
```
