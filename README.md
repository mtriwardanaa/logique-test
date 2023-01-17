<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Import Postman Collection

Cara import postman collection:

- [Klik link disini](https://api.postman.com/collections/8315413-24337bad-92e0-407b-99ad-b7fcbdf8d043?access_key=PMAT-01GPZHWRW3GM3XARTP7JAMGH3Z).
- Buka postman aplikasi.
- pilih menu import.
- Pilih link pada menu navbar.
- Masukkan link pada point 1, ke field enter URL pada postman [database ORM](https://laravel.com/docs/eloquent).

postman collection sudah berhasil di import.

## Instalasi project

- Clone project dari github ssh
- Copy .env.example ke .env
- Jalankan php dilocal (jika menggunakan xampp, start apache dan mysql)
- Buat database baru dengan nama "api_test" (sesuaikan dengan nama database pada file env)
- Jalankan perintah "composer update" (dipastikan dikomputer sudah terinstall php dan composer)
- Jalannkan perintah "php artisan migrate" untuk membuat database
- Jalan perintah "php artsan serve" untuk menjalankan aplikasi

Jika sudah muncul keterangan "Server running on [http://127.0.0.1:8000].", artinya aplikasi sudah berjalan
