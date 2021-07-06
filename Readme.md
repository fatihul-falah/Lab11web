# Praktikum 11 - Pemrograman Web (PHP Framework)

```
Fatihul Falah - 311910460
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

lalu jalankan perintah
```
php spark serve
```

<br>Codeigniter juga menyediakan mode debugging/development yang dapat menampilkan error/kesalahan dalam kode program. Cara mengaktifkannya dengan mengubah nama file `env` menjadi `.env` kemudian buka filenya dan ubah nilai <b>CI_ENVIRONMENT</b> menjadi <b>development</b>.
![SS5](https://i.imgur.com/NPaelB9.png)

<br>Maka pesan kesalahan akan ditampilkan.
![SS6](https://i.imgur.com/Ps9dQum.png)

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
- Method ini dapat diakses dengan menggunakan alamat: http://localhost:8080/page/tos
![SS10](https://i.imgur.com/hGJoDrN.png)

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

- Kemudian refresh browser atau akses alamat http://localhost:8080/about

## Pertanyaan dan tugas
Lengkapi kode program untuk menu lainnya yang ada pada Controller Page, sehingga
semua link pada navigasi header dapat menampilkan tampilan dengan layout yang
sama.
## hasil
tampilan page about:
![ss11](https://i.imgur.com/RmhgXmn.png)
tampilan page artikel:
![ss12](https://i.imgur.com/mKiHrzW.png)
tampilan page kontak
![ss13](https://i.imgur.com/Rp0dOVt.png)
# Pratikum 12

## Membuat database
```
CREATE DATABASE lab_ci4;
```
![1](https://i.imgur.com/HFYUpVS.png)
### membuat tabel
```
CREATE TABLE artikel (
 id INT(11) auto_increment,
 judul VARCHAR(200) NOT NULL,
 isi TEXT,
 gambar VARCHAR(200),
 status TINYINT(1) DEFAULT 0,
 slug VARCHAR(200),
 PRIMARY KEY(id)
);
```
![2](https://i.imgur.com/pxIoU8h.png)
![3](https://i.imgur.com/6BmyVDg.png)
## Konfigurasi koneksi database
Selanjutnya membuat konfigurasi untuk menghubungkan dengan database server.
Konfigurasi dapat dilakukan dengan du acara, yaitu pada file app/config/database.php
atau menggunakan file `.env`. Pada praktikum ini kita gunakan konfigurasi pada file `.env`. 
![4](https://i.imgur.com/MCZI7qT.png)
## Membuat Model
Selanjutnya adalah membuat Model untuk memproses data Artikel. Buat file baru pada
direktori `app/Models` dengan nama `ArtikelModel.php`
```
<?php
namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['judul', 'isi', 'status', 'slug', 'gambar'];
}
```
![5](https://i.imgur.com/KVfN4Ga.png)
## Membuat Controller
Buat Controller baru dengan nama `Artikel.php` pada direktori `app/Controllers`
```
<?php
namespace App\Controllers;

use App\Models\ArtikelModel;

class Artikel extends BaseController
{
    public function index()
    {
        $title = 'Daftar Artikel';
        $model = new ArtikelModel();
        $artikel = $model->findAll();
        return view('artikel/index', compact('artikel', 'title'));
    }
}
```
![6](https://i.imgur.com/bZZZ1o7.png)
## Membuat View
Buat direktori folder baru dengan nama `artikel` pada direktori `app/views`, kemudian buat file
baru dengan nama `index.php`.
```
<?= $this->include('template/header'); ?>

<?php if($artikel): foreach($artikel as $row): ?>
<article class="entry">
    <h2><a href="<?= base_url('/artikel/' . $row['slug']);?>"><?=$row['judul']; ?></a></h2>
    <img src="<?= base_url('/gambar/' . $row['gambar']);?>" alt="<?=$row['judul']; ?>">
    <p><?= substr($row['isi'], 0, 200); ?></p>
</article>
<hr class="divider" />
<?php endforeach; else: ?>
<article class="entry">
    <h2>Belum ada data.</h2>
</article>
<?php endif; ?>

<?= $this->include('template/footer'); ?>
```
![7](https://i.imgur.com/N4Hhv3o.png)
lalu ubah routes baru pada `Routes.php` di `app/config`
```
$routes->get('/artikel/(:any)', 'Artikel::view/$1');
```
![8](https://i.imgur.com/AFG0SJY.png)
Selanjutnya buka browser kembali, dengan mengakses url http://localhost:8080/artikel
![9](https://i.imgur.com/eKMzkXP.png)
Belum ada data yang diampilkan. Kemudian coba tambahkan beberapa data pada
database agar dapat ditampilkan datanya
```
INSERT INTO artikel (judul, isi, slug) VALUE
('Artikel pertama', 'Lorem Ipsum adalah contoh teks atau dummy dalam industri
percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi
standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak
dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah
buku contoh huruf.', 'artikel-pertama'),
('Artikel kedua', 'Tidak seperti anggapan banyak orang, Lorem Ipsum bukanlah
teks-teks yang diacak. Ia berakar dari sebuah naskah sastra latin klasik dari
era 45 sebelum masehi, hingga bisa dipastikan usianya telah mencapai lebih
dari 2000 tahun.', 'artikel-kedua');

```
![10](https://i.imgur.com/kQP4RSR.png)
Refresh kembali browser, sehingga akan ditampilkan hasilnya.
![11](https://i.imgur.com/xeHImjO.png)
## Membuat Tampilan Detail Artikel
Tampilan pada saat judul berita di klik maka akan diarahkan ke halaman yang berbeda.
Tambahkan fungsi baru pada `Controller/Artikel.php` dengan nama `view()`.
```
    public function view($slug)
    {
        $model = new ArtikelModel();
        $artikel = $model->where([
            'slug' => $slug
        ])->first();

    // Menampilkan error apabila data tidak ada.
        if (!$artikel)
        {
            throw PageNotFoundException::forPageNotFound();
        }
        $title = $artikel['judul'];
        return view('artikel/detail', compact('artikel', 'title'));
    }
```
![12](https://i.imgur.com/tvWO4f6.png)
## Membuat View Detail
Buat view baru untuk halaman detail dengan nama app/`views/artikel/detail.php`.
```
<?= $this->include('template/header'); ?>

<article class="entry">
    <h2><?= $artikel['judul']; ?></h2>
    <img src="<?= base_url('/gambar/' . $artikel['gambar']);?>" alt="<?=
    $artikel['judul']; ?>">
    <p><?= $artikel['isi']; ?></p>
</article>

<?= $this->include('template/footer'); ?>
```
![13](https://i.imgur.com/0u6ODfi.png)
## Membuat Menu Admin
Menu admin adalah untuk proses CRUD data artikel. Buat method baru pada `Controller/Artikel` dengan nama `admin_index()`.
```
public function admin_index()
    {
        $title = 'Daftar Artikel';
        $model = new ArtikelModel();
        $artikel = $model->findAll();
        return view('artikel/admin_index', compact('artikel', 'title'));
    }
```
![14](https://i.imgur.com/eFIgqT0.png)
Selanjutnya buat view untuk tampilan admin dengan nama `admin_index.php` di direktori Views/artikel/
```
<?= $this->include('template/admin_header'); ?>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php if($artikel): foreach($artikel as $row): ?>
    <tr>
        <td><?= $row['id']; ?></td>
        <td>
            <b><?= $row['judul']; ?></b>
            <p><small><?= substr($row['isi'], 0, 50); ?></small></p>
        </td>
        <td><?= $row['status']; ?></td>
        <td>
            <a class="btn" href="<?= base_url('/admin/artikel/edit/' .$row['id']);?>">Ubah</a>
            <a class="btn-danger" onclick="return confirm('Yakin menghapus data?');" href="<?= base_url('/admin/artikel/delete/' .
            $row['id']);?>">Hapus</a>
        </td>
    </tr>
    <?php endforeach; else: ?>
    <tr>
        <td colspan="4">Belum ada data.</td>
    </tr>
    <?php endif; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </tfoot>
</table>

<?= $this->include('template/admin_footer'); ?>
```
![15](https://i.imgur.com/eFqLwJM.png)
Tambahkan routing untuk menu admin seperti berikut:
```
$routes->group('admin', function($routes) {
    $routes->get('artikel', 'Artikel::admin_index');
    $routes->add('artikel/add', 'Artikel::add');
    $routes->add('artikel/edit/(:any)', 'Artikel::edit/$1');
    $routes->get('artikel/delete/(:any)', 'Artikel::delete/$1');
});
```
![16](https://i.imgur.com/Psu8hu9.png)
buat template halaman admin di `app/Views/template`

`admin_footer.php`:
```
    <footer>
        <p>&copy; 2021 - Universitas Pelita Bangsa</p>
    </footer>
    </div>
</body>
</html>
```
![17](https://i.imgur.com/RAxl8sy.png)
`admin_header.php`:
```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('/adminstyle.css');?>">
</head>
<body>
    <div id="container">
    <header>
        <h1>Halaman Admin</h1>
    </header>
    <nav>
        <a href="<?= base_url('/admin/artikel');?>" class="active">Dashboard</a>
        <a href="<?= base_url('/artikel');?>">Artikel</a>
        <a href="<?= base_url('/admin/artikel/add');?>">Tambah Artikel</a>
    </nav>
    <section id="wrapper">
```
![18](https://i.imgur.com/3k16qkF.png)
lalu buat `adminstyle.css` di folder ci4/public
```
/* Reset CSS */
* {
    margin: 0;
    padding: 0;
}
body {
    line-height:1;
    font-size:100%;
    font-family:'Open Sans', sans-serif;
    color:#5a5a5a;
}
#container {
    width: 980px;
    margin: 0 auto;
    box-shadow: 0 0 1em #cccccc;
}

/* header */
header {
    padding: 20px;
}
header h1 {
    margin: 20px 10px;
    color: #b5b5b5;
}

/* navigasi */
nav {
    display: block;
    background-color: #1f5faa;
}
nav a {
    padding: 15px 30px;
    display: inline-block;
    color: #ffffff;
    font-size: 14px;
    text-decoration: none;
    font-weight: bold;
}
nav a.active,
nav a:hover {
    background-color: #2b83ea;
}

/* footer */
footer {
    clear: both;
    background-color: #1d1d1d;
    padding: 20px;
    color:  #eee
}

/* ADMIN TABEL */
body{
    font-family: sans-serif;
}
table{
    border-collapse: collapse;
    margin: 20px;
    width: 95%;
}
table td{
    border: 1px solid #c9c9c9;
    font-size: 19px;
    padding: 10px 8px;
}
table th {
    background:#4d8cd4;
    color:#ffffff;
    font-size: 17px;
    text-align: left;
    border: 1px solid #c9c9c9;
    padding: 13px 15px;
}
table tr {
    background:#ffffff;
    text-align: left;
}
tr:hover{
    background: #e7e7e7;
}

/* ADMIN TOMBOL */
.btn{
    font-size: 14px;
    background-color: #afafaf;
    color: #444444;
    border-radius: 5px;
    padding: 10px 20px;
    margin-top: 8x;
    text-decoration: none;
}

.btn-danger{
    font-size: 14px;
    background-color: rgb(223, 35, 35);
    color: white;
    border-radius: 5px;
    padding: 10px 20px;
    margin-top: 8x;
    text-decoration: none;
}

a:active,
a:hover{
    opacity: 80%;
}

/* TAMBAH ARTIKEL */
textarea{
    width: 94%;
    padding: 10px;
    border: 2px solid gray;
    box-sizing: border-box;
    font-size: 15px;
    margin-left: 20px;
}

input[type=text]{
    width: 94%;
    padding: 10px;
    border: 2px solid gray;
    box-sizing: border-box;
    font-size: 15px;
    margin: 20px;   
}

input[type=submit]{
    padding: 10px;
    background-color: rgb(30, 117, 216);
    color: white;
    box-sizing: border-box;
    font-size: 15px;
    margin: 20px;   
}

input[type=submit]:active,
input[type=submit]:hover{
    opacity: 80%;
}

h2{
    margin-top: 20px;
    margin-left: 20px;
}
```
Akses menu admin dengan url http://localhost:8080/admin/artikel
![19](https://i.imgur.com/fITQJl7.png)
## Menambah Data Artikel
Tambahkan fungsi/method baru pada `Controller/Artikel` dengan nama `add()`
```
public function add()
    {
        // validasi data.
        $validation = \Config\Services::validation();
        $validation->setRules(['judul' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();
    
        if ($isDataValid)
        {
            $artikel = new ArtikelModel();
            $artikel->insert([
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
                'slug' => url_title($this->request->getPost('judul')),
            ]);
            return redirect('admin/artikel');
        }
        $title = "Tambah Artikel";
        return view('artikel/form_add', compact('title'));
    }

```
![20](https://i.imgur.com/F5teEnQ.png)
Kemudian buat view untuk form tambah dengan nama `form_add.php`
```
<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>
<form class="tambah" action="" method="post">
    <p>
        <input type="text" name="judul">
    </p>
    <p>
        <textarea name="isi" cols="50" rows="10"></textarea>
    </p>
    <p><input type="submit" value="Kirim" class="btn btn-large"></p>
</form>

<?= $this->include('template/admin_footer'); ?>
```
![21](https://i.imgur.com/uY72C12.png)
![22](https://i.imgur.com/ShxSotm.png)
## Mengubah Data
Tambahkan fungsi/method baru pada `Controller/Artikel` dengan nama `edit()`. 
```
public function edit($id)
    {
        $artikel = new ArtikelModel();
        // validasi data.
        $validation = \Config\Services::validation();
        $validation->setRules(['judul' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();
        
        if ($isDataValid)
        {
            $artikel->update($id, [
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
            ]);
            return redirect('admin/artikel');
        }
        
        // ambil data lama
        $data = $artikel->where('id', $id)->first();
        $title = "Edit Artikel";
        return view('artikel/form_edit', compact('title', 'data'));
    }
```
![23](https://i.imgur.com/Vmgljje.png)
Kemudian buat view untuk form tambah dengan nama `form_edit.php`
```
<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>
<form action="" method="post">
    <p>
        <input type="text" name="judul" value="<?= $data['judul'];?>" >
    </p>
    <p>
        <textarea name="isi" cols="50" rows="10"><?=$data['isi'];?></textarea>
    </p>
    <p><input type="submit" value="Kirim" class="btn btn-large"></p>
</form>

<?= $this->include('template/admin_footer'); ?>
```
![24](https://i.imgur.com/kpZN04x.png)
![25](https://i.imgur.com/DlPuGYH.png)
## Menghapus Data
Tambahkan fungsi/method baru pada `Controller/Artikel` dengan nama `delete()`. 
```
 public function delete($id)
    {
        $artikel = new ArtikelModel();
        $artikel->delete($id);
        return redirect('admin/artikel');
    }
```
![26](https://i.imgur.com/7CH3cKG.png)

## Pertanyaan dan Tugas
Selesaikan programnya sesuai Langkah-langkah yang ada. Anda boleh melakukan
improvisasi.

## hasil
penyelesaian program sudah disertakan di langkah-langkah di atas

* tambah artikel
![27](https://i.imgur.com/K9qI2VB.png)
![28](https://i.imgur.com/e3S6CVf.png)
* edit artikel
![29](https://i.imgur.com/nIv7wfg.png)
![30](https://i.imgur.com/nIv7wfg.png)
* hapus artikel
![31](https://i.imgur.com/dz5ErXO.png)
![32](https://i.imgur.com/hy0IPB0.png)

# Pratikum 13 Framework lanjutan - modul login

## persiapkan Database
Untuk memulai membuat modul Login, yang perlu disiapkan adalah database server menggunakan MySQL. Pastikan MySQL Server sudah dapat dijalankan melalui XAMPP.
```
CREATE TABLE user (
 id INT(11) auto_increment,
 username VARCHAR(200) NOT NULL,
 useremail VARCHAR(200),
 userpassword VARCHAR(200),
 PRIMARY KEY(id)
);
```
![1](https://i.imgur.com/OL3gn3J.png)
![2](https://i.imgur.com/mNqwJAh.png)

## Membuat Model User
Selanjutnya adalah membuat Model untuk memproses data Login. Buat file baru pada direktori `app/Models` dengan nama `UserModel.php`
```
<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['username', 'useremail', 'userpassword'];
}
```
![3](https://i.imgur.com/KpTcqV0.png)
## Membuat Controller User
Buat Controller baru dengan nama `User.php` pada direktori `app/Controllers`. Kemudian tambahkan method `index()` untuk menampilkan daftar user, dan method `login()` untuk proses login.
```
<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $title = 'Daftar User';
        $model = new UserModel();
        $users = $model->findAll();
        return view('user/index', compact('users', 'title'));
    }

    public function login()
    {
        helper(['form']);
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        if (!$email)
        {
            return view('user/login');
        }

        $session = session();
        $model = new UserModel();
        $login = $model->where('useremail', $email)->first();
        if ($login)
        {
            $pass = $login['userpassword'];
            if (password_verify($password, $pass))
            {
                $login_data = [
                    'user_id' => $login['id'],
                    'user_name' => $login['username'],
                    'user_email' => $login['useremail'],
                    'logged_in' => TRUE,
                ];
                $session->set($login_data);
                return redirect('admin/artikel');
            }
            else
            {
                $session->setFlashdata("flash_msg", "Password salah.");
                return redirect()->to('/user/login');
            }

        }
        else
        {
            $session->setFlashdata("flash_msg", "email tidak terdaftar.");
            return redirect()->to('/user/login');
        }
    }
}
```
![4-1](https://i.imgur.com/rPGIBHJ.png)
![4-2](https://i.imgur.com/EHGQmEA.png)
## Membuat View Login
Buat direktori baru dengan nama `user` pada direktori `app/views`, kemudian buat file baru dengan nama `login.php`. 
```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('/style.css');?>">
</head>
<body>
    <div id="login-wrapper">
            <h1>Sign In</h1>
            <?php if(session()->getFlashdata('flash_msg')):?>
                <div class="alert alert-danger"><?=
session()->getFlashdata('flash_msg') ?></div>
            <?php endif;?>
            <form action="" method="post">
                <div class="mb-3">
                <label for="InputForEmail" class="form-label">Emailaddress</label>
                <input type="email" name="email" class="form-control"id="InputForEmail" value="<?= set_value('email') ?>">
                </div>
                <div class="mb-3">
                    <label for="InputForPassword"class="form-label">Password</label>
                    <input type="password" name="password"class="form-control" id="InputForPassword">
                </div>
                <button type="submit" class="btnbtn-primary">Login</button>
            </form>
    </div>
</body>
</html>
```
![5](https://i.imgur.com/Ic46qBp.png)
## Membuat Database Seeder
Database seeder digunakan untuk membuat data dummy. Untuk keperluan ujicoba modul login, kita perlu memasukkan data user dan password kedaalam database. Untuk itu buat database seeder untuk tabel user. Buka CLI, kemudian tulis perintah berikut:
```
php spark make:seeder UserSeeder
```
![6-1](https://i.imgur.com/iHAiBh6.png)
Selanjutnya, buka file `UserSeeder.php` yang berada di lokasi direktori `/app/Database/Seeds/UserSeeder.php` kemudian isi dengan kode berikut:
```
<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run()
	{
		$model = model('UserModel');
		$model->insert([
			'username' => 'admin',
			'useremail' => 'admin@email.com',
			'userpassword' => password_hash('admin123', PASSWORD_DEFAULT),
		]);
	}
}
```
![6-2](https://i.imgur.com/dU9ehvS.png)
Selanjutnya buka kembali CLI dan ketik perintah berikut:
```
php spark db:seed UserSeeder
```
![6-3](https://i.imgur.com/3N8trXg.png)
## Uji Coba Login
Selanjutnya buka url http://localhost:8080/user/login seperti berikut:
![7](https://i.imgur.com/E6NHBzS.png)
## Menambahkan Auth Filter
Selanjutnya membuat filer untuk halaman admin. Buat file baru dengan nama `Auth.php` pada direktori `app/Filters`. 
```
<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // jika user belum login
        if(! session()->get('logged_in')){
            // maka redirct ke halaman login
            return redirect()->to('/user/login');
        }
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
```
![8-1](https://i.imgur.com/k4D6xQ4.png)
Selanjutnya buka file `app/Config/Filters.php` tambahkan kode berikut:
```
'auth' => App\Filters\Auth::class
```
![8-2](https://i.imgur.com/hn4mlSE.png)
Selanjutnya buka file `app/Config/Routes.php` dan sesuaikan kodenya.
![8-3](https://i.imgur.com/yNX8lxD.png)
## Percobaan Akses Menu Admin
Buka url dengan alamat http://localhost:8080/admin/artikel ketika alamat tersebut diakses maka, akan dimuculkan halaman login. 
![9](https://i.imgur.com/hqlL9LF.png)
## Fungsi Logout
Tambahkan method logout pada `Controller User` seperti berikut:
```
public function logout()
 {
 session()->destroy();
 return redirect()->to('/user/login');
 }

```
![10](https://i.imgur.com/cklkmUv.png)
## Pertanyaan dan Tugas
Selesaikan programnya sesuai Langkah-langkah yang ada. Anda boleh melakukan
improvisasi.
## hasil
css login:
![11](https://i.imgur.com/g8omo4h.png)
![12](https://i.imgur.com/4BZNjSB.png)
penambahan route loguot:
![13](https://i.imgur.com/pzcEYVp.png)
# Praktikum 14: Pagination dan Pencarian
## Membuat Pagination
Pagination merupakan proses yang digunakan untuk membatasi tampilan yang panjang dari data yang banyak pada sebuah website. Fungsi pagination adalah memecah tampilan menjadi beberapa halaman tergantung banyaknya data yang akan ditampilkan pada setiap halaman

Pada Codeigniter 4, fungsi pagination sudah tersedia pada Library sehingga cukup mudah menggunakannya.

Untuk membuat pagination, buka Kembali `Controller\Artikel`, kemudian modifikasi kode pada method `admin_index` seperti berikut.
```
    public function admin_index()
    {
        $title = 'Daftar Artikel';
        $model = new ArtikelModel();
        $data = [
            'title' => $title,
            'artikel' => $model->paginate(10), #data dibatasi 10 record perhalaman
            'pager' => $model->pager,
        ];
        return view('artikel/admin_index',$data);
    }
```
![1](https://i.imgur.com/TU6mwSM.png)
Kemudian buka file `views/artikel/admin_index.php` dan tambahkan kode berikut dibawah deklarasi tabel data.
```
<?= $pager->links(); ?>
```
![2](https://i.imgur.com/hz2wHHj.png)
![3](https://i.imgur.com/BzL1OBN.png)
## Membuat Pencarian
Pencarian data digunakan untuk memfilter data.

Untuk membuat pencarian data, buka kembali `Controller\Artikel`, pada method `admin_index` ubah kodenya seperti berikut 
```
public function admin_index()
    {
        $title = 'Daftar Artikel'; 
        $q = $this->request->getVar('q') ?? ''; 
        $model = new ArtikelModel();
        $data = [
            'title' => $title,
            'q'     => $q,
            'artikel' => $model->paginate(10), #data dibatasi 10 record perhalaman
            'pager' => $model->pager,
        ];
        return view('artikel/admin_index', $data);
    }
```
![4](https://i.imgur.com/i79UNUj.png)
Kemudian buka kembali file `views/artikel/admin_index.php` dan tambahkan form pencarian sebelum deklarasi tabel seperti berikut:
```
<form method="get" class="form-search">
    <input type="text" name="q" value="<?= $q; ?>" placeholder="Cari data">
    <input type="submit" value="Cari" class="btn btn-primary">
</form>
```
![5](https://i.imgur.com/9RHN5qE.png)
Dan pada link pager ubah seperti berikut
```
<?= $pager->only(['q'])->links(); ?>
```
![6](https://i.imgur.com/sPD9yO6.png)
Selanjutnya ujicoba dengan membuka kembali halaman admin artikel, masukkan kata kunci tertentu pada form pencarian.
![7](https://i.imgur.com/HiHN4kY.png)
## Upload Gambar
Menambahkan fungsi unggah gambar pada tambah artikel. Buka kembali `Controller/Artikel`, sesuaikan kode pada method `add` seperti berikut:
```
public function add()
    {
        // validasi data.
        $validation = \Config\Services::validation();
        $validation->setRules(['judul' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();
    
        if ($isDataValid)
        {
            $file = $this->request->getFile('gambar');
            $file->move(ROOTPATH . 'public/gambar');

            $artikel = new ArtikelModel();
            $artikel->insert([
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
                'slug' => url_title($this->request->getPost('judul')),
                'gambar' => $file->getName()
            ]);
            return redirect('admin/artikel');
        }
        $title = "Tambah Artikel";
        return view('artikel/form_add', compact('title'));
    }
```
![10](https://i.imgur.com/mvLWIrI.png)
Kemudian pada file `views/artikel/form_add.php` tambahkan field input file seperti
berikut.
```
    <p>
        <input type="file" name="gambar">
    </p>

```
![8](https://i.imgur.com/beVul8P.png)
Dan sesuaikan tag form dengan menambahkan ecrypt type seperti berikut
```
<form action="" method="post" enctype="multipart/form-data">
```
Ujicoba file upload dengan mengakses menu tambah artikel.
![9](https://i.imgur.com/5eVhVBc.png)