# Praktikum 11 - Pemrograman Web (PHP Framework)

```
Fatihul Falah - 3119104610
TI.19.A.2
```

### Persiapan
Mengaktifkan beberapa ekstensi php, diantaranya:
- php-json ekstension untuk bekerja dengan JSON;
- php-mysqlnd native driver untuk MySQL;
- php-xml ekstension untuk bekerja dengan XML;
- php-intl ekstensi untuk membuat aplikasi multibahasa;
- libcurl (opsional), jika ingin pakai Curl</br>
![SS1](https://i.imgur.com/qvBcWB5.png)

Hapus tanda ; (titik koma) pada bagian extension yang akan diaktifkan.
![SS2](https://i.imgur.com/5jIFycG.png)

## Install CodeIgniter 4
- Codeigniter dapat didownload dari website https://codeigniter.com/download
- Extrak file zip Codeigniter ke direktori htdocs/lab11_php_ci.
- Ubah nama direktory framework-4.x.xx menjadi ci4.
- Buka browser dengan alamat http://localhost/lab11_php_ci/ci4/public/
![SS3](https://i.imgur.com/4f2xGcm.png)

<br>Codeigniter menyediakan CLI, untuk mengaksesnya buka terminal lalu arahkan ke direktori project yang akan dibuat. Kemudian jalankan perintah `php spark` untuk memanggil CLI codeigniter.
![SS4](https://i.imgur.com/sINPEJj.png)

<br>Codeigniter juga menyediakan mode debugging/development yang dapat menampilkan error/kesalahan dalam kode program. Cara mengaktifkannya dengan mengubah nama file `env` menjadi `.env` kemudian buka filenya dan ubah nilai <b>CI_ENVIRONMENT</b> menjadi <b>development</b>.
![SS5](https://i.imgur.com/NPaelB9.png)

<br>Maka pesan kesalahan akan ditampilkan.
![SS6](https://i.imgur.com/2BMRKxs.png)

### Membuat Route
- Router terletak pada file app/config/Routes.php
- Tambahkan kode berikut di dalam Routes.php
```
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');

```
- Untuk mengetahui route yang ditambahkan sudah benar, buka CLI dan jalankan
perintah `php spark routes`
![SS18](https://i.imgur.com/pCx083w.png)

- Selanjutnya mencoba akses route yang telah dibuat dengan mengakses 
http://localhost/lab11_php_ci/ci4/public/about
![SS7](https://i.imgur.com/2cv1K9w.png)
- Ketika diakses akan mucul tampilan error 404 file not found, itu artinya file/page
tersebut tidak ada. Untuk dapat mengakses halaman tersebut, harus dibuat terlebih
dahulu Contoller yang sesuai dengan routing yang dibuat yaitu Contoller Page.

### Membuat Controller
- Membuat file <b>page.php</b> di dalam direktori Controller (/app/Controllers)
![SS19](https://i.imgur.com/pB4bGri.png)

- Kemudian refresh browser maka halaman sudah dapat diakses dan menampilkan hasilnya.
![SS8](https://i.imgur.com/brHSyvL.png)

- Tambahkan method baru pada <b>Controller Page</b> seperti berikut
```
public function tos()
{
 echo "ini halaman Term of Services";
}

```
- Method ini dapat diakses dengan menggunakan alamat: http://localhost/lab11_php_ci/ci4/public/page/tos
![SS10](https://i.imgur.com/l8u27Kk.png)

### Membuat View
- Membuat file <b>about.php</b> di dalam direktori View (/app/view/about.php)
```
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title><?= $title; ?></title>
</head>
<body>
 <h1><?= $title; ?></h1>
 <hr>
 <p><?= $content; ?></p>
</body>
</html>

```

- Ubah method about pada class Controller Page menjadi seperti berikut:
```
public function about()
{
 return view('about', [
 'title' => 'Halaman Abot',
 'content' => 'Ini adalah halaman abaut yang menjelaskan tentang isi
halaman ini.'
 ]);
}
```
lalu refresh untuk melihat hasil
### Membuat Layout Web dengan CSS
-Pada dasarnya layout web dengan css dapat diimplamentasikan dengan mudah pada
codeigniter. Yang perlu diketahui adalah, pada Codeigniter 4 file yang menyimpan asset
css dan javascript terletak pada direktori public.
Buat file css pada direktori public dengan nama style.css (copy file dari praktikum
lab4_layout. Kita akan gunakan layout yang pernah dibuat pada praktikum 4.

- Kemudian buat folder template pada direktori view, lalu buat file <b>header.php</b> dan <b>footer.php</b>.
<br>File <b>app/view/template/header.php</b>
```
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title><?= $title; ?></title>
 <link rel="stylesheet" href="<?= base_url('/style.css');?>">
</head>
<body>
 <div id="container">
 <header>
 <h1>Layout Sederhana</h1>
 </header>
 <nav>
 <a href="<?= base_url('/');?>" class="active">Home</a>
 <a href="<?= base_url('/artikel');?>">Artikel</a>
 <a href="<?= base_url('/about');?>">About</a>
 <a href="<?= base_url('/contact');?>">Kontak</a>
 </nav>
 <section id="wrapper">
 <section id="main">
```
<br>File <b>app/view/template/footer.php</b>
```
</section>
 <aside id="sidebar">
 <div class="widget-box">
 <h3 class="title">Widget Header</h3>
 <ul>
 <li><a href="#">Widget Link</a></li>
 <li><a href="#">Widget Link</a></li>
 </ul>
 </div>
 <div class="widget-box">
 <h3 class="title">Widget Text</h3>
 <p>Vestibulum lorem elit, iaculis in nisl volutpat, malesuada
tincidunt arcu. Proin in leo fringilla, vestibulum mi porta, faucibus felis.
Integer pharetra est nunc, nec pretium nunc pretium ac.</p>
 </div>
 </aside>
 </section>
 <footer>
 <p>&copy; 2021 - Universitas Pelita Bangsa</p>
 </footer>
 </div>
</body>
</html>
```

- Kemudian ubah file about.php <b>/app/view/about.php</b> seperti berikut.
```
<?= $this->include('template/header'); ?>
<h1><?= $title; ?></h1>
<hr>
<p><?= $content; ?></p>
<?= $this->include('template/footer'); ?>
```

- Kemudian refresh browser atau akses alamat http://localhost/lab11_php_ci/ci4/public/about
