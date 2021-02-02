# Metamata-code-challenge-backend

Membuat media untuk berbagi cerita; website sederhana untuk membaca dan memposting cerita;

## Cara Instalasi/Run

-   Clone repository ini

```sh
$ git clone https://github.com/LinggaWahyu/Metamata-code-challenge-backend.git
```

-   Masuk ke dalam lokasi folder aplikasi

```sh
$ cd Metamata-code-challenge-backend/
```

-   Install dependencies dengan menjalankan perintah

```sh
$ composer install
```

-   Buat file .env dengan berdasarkan file .env.example

```sh
$ cp .env.example .env
```

-   Setelah berhasil membuat file .env, beirkutnya jalankan perintah

```sh
$ php artisan key:generate
```

-   Buat database baru dengan nama **metamata_code_challenge_backend**

-   Setelah selesai membuat database, jalankan perintah berikut

```sh
$ php artisan migrate
```

-   Terakhir, untuk membukanya di web browser, jalankan perintah

```sh
$ php artisan serve
```

-   Lalu jalankan http://localhost:8000

-   Register akun terlebih dahulu untuk menjalankan aplikasi
