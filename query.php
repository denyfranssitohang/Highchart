<?php

// konekso ke database
$koneksi       = mysqli_connect("localhost", "root", "", "visualization");

// queri database
$kategori      = mysqli_query($koneksi, "SELECT DISTINCT te FROM all_data_sumatera_new");
$acehbaratdaya = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='ACEH BARAT DAYA'");
$acehbarat     = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='ACEH BARAT'");
$acehbesar     = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='ACEH BESAR'");
$acehjaya      = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='ACEH JAYA'");
$acehselatan   = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='ACEH SELATAN'");
$acehsingkil   = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='ACEH SINGKIL'");
$acehtamiang   = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='ACEH TAMIANG'");
$acehtengah    = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='ACEH TENGAH'");
$acehtenggara  = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='ACEH TENGGARA'");
$acehtimur     = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='ACEH TIMUR'");
$acehutara     = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='ACEH UTARA'");
$benermeriah   = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='BENER MERIAH'");
$bireuen       = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='BIREUEN'");
$gayolues      = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='GAYO LUES'");
$kotabandaaceh = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='KOTA BANDA ACEH'");
$kotalangsa    = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='KOTA LANGSA'");
$kotalhokseumawe = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='KOTA LHOKSEUMAWE'");
$kotasabang    = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='KOTA SABANG'");
$kotasubulussalam = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='KOTA SUBULUSSALAM'");
$naganraya     = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='NAGAN RAYA'");
$pidiejaya     = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='PIDIE JAYA'");
$pidie         = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='PIDIE'");
$simeulue      = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='SIMEULUE'");


// $aceh = mysqli_query($koneksi, "SELECT SUM(density_index) AS jumlah FROM dataprovinsi WHERE provinsi='ACEH'");
?>
