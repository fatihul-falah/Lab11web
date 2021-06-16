<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <title><?= $title; ?></title> 
</head> 
<body>
    <?= $this->include('template/header'); ?>
    <section id="introduce">
        <div class="row">
            <img src="2019-05-19.jpg" title="Fatihul Falah" alt="" class="image-circle" width="230"
            style="float: left; border: 2px solid black;">
            <h1>About</h1>
            <p>Nama saya Fatihul Falah. Saya adalah seorang mahasiswa dari <i>Universitas Pelita Bangsa</i> yang saat ini sedang
                mempelajari materi PHP Framework dengan menggunakan (Codeigniter) dalam mata kuliah <i>Pemrograman Web</i>.</p>
        </div>
    </section>
    <?= $this->include('template/footer'); ?>
</body> 
</html>