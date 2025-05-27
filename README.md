### Persiapan

-   PHP >= 8.2
-   composer
-   izinkan ekxtensi sodium di php.ini dengan menghapus tanda ";" di baris extension=sodium. karena ada library yang membutuhkan ekstensi tersebut.

### Instalasi

-   clone repository
-   buka terminal lalu masuk ke folder project
-   jalankan perintah-perintah berikut:
-   `composer install`
-   steup env
    `cp .env.example .env`
    atur koneksi database dan juga tambahkan kredential pusher berikut
    ```
    PUSHER_APP_ID=1929060
    PUSHER_APP_KEY=7dd70d197b37c90c4696
    PUSHER_APP_SECRET=dc5fc612b57de3ce3e26
    PUSHER_APP_CLUSTER=ap1
    PUSHER_PORT=443
    PUSHER_SCHEME=https
    ```
-   `php artisan jwt:secret` untuk membuat key jwt
-   `php artisan key:generate`
-   `php artisan migrate`
-   `php artisan optimize:clear`
-   jalankan `php artisan db:seed UserSeeder` untuk membuat satu user
-   untuk data dummy order Anda bisa menjalankan `php artisan db:seed OrderSeeder`. akan membuat 5000 order dengan masing-masing 5 item
-   buka terminal baru kemudian jalankan `php artisan queue:work` untuk menjalankan queue
-   `php artisan storage:link` untuk penyimpanan file excel
-   `php artisan serve`

### API Endpoint

-   /orders | GET : melihat semua order
-   /orders/id | GET : melihat order tertentu dengan id
-   /orders | POST : menambah order baru
-   /orders/id | PUT/PATCH : edit order
-   /orders/id | DELETE : hapus order
-   /orders-export | POST : export order

Selanjutnya silahkan setup front end dan jalankan aplikasi
