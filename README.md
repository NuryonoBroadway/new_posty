## Penggunaan

- **pertama**

jangan lupa install dan jalankan docker pada laptop/pc, lalu clone folder github : `git clone https://github.com/NuryonoBroadway/new_posty.git`

- **kedua**

silahkan pull docker berikut: (optional)

`docker pull karakuzen/site-195410096`
`docker pull karakuzen/php-195410096`

perintah kedua bersifat optional karena docker-compose akan pull image dengan sendirinya jika image tidak ada pada laptop/pc,

- **ketiga**

choose directory ke new_posty `cd new_posty`

## up

up docker-compose, perintah **up** adalah menjalankan perintah untuk membuat container, networks, image, volumes yang tertera pada `docker-compose.yml`. 

`docker-compose up -d --build site` => `-d` adalah detach, menjalankan container di background, lalu mencetak nama container baru. `--build` membuat image sebelum memulai container.


setelah up cek di browser, `localhost:8080`, setelah berhasil akses `localhost:8080`, run `docker-compose run --rm artisan migrate`, untuk migrate table ke database mysql, jika tidak maka akan muncul error.

nama container yang berjalan berserta port:
- **nginx** - `:8080`
- **mysql** - `:3306`
- **php** - `:9000`

dikarenakan web based on laravel, maka ada 3 komponen utama yang mungkin akan berguna dalam edit web yaitu :
- `docker-compose run --rm composer update` => update composer
- `docker-compose run --rm npm run dev` => npm run dev : kompilasi untuk development
- `docker-compose run --rm artisan migrate` => untuk migrate table ke database, dalam web ini berbasis mysql

`docker-compose run --rm ....` => `--rm` berfungsi untuk menghapus container setelah run, misal kita sudah run untuk migrasi table kedatabase, maka secara otomatis setelah selesai container artisan akan hilang atau terhapus, karena terdapat option `--rm`.

## down

down berfungsi untuk menghentikan proses container dan menhapus container, networks, volumes, dan image yang dibuat oleh `up`