# backendbinar





1.	Perancangan aplikasi antar makanan  dan pelanggan hanya dilayani dengan mobile apps,
a.	Desainlah stack backend/micro service layanan tersebut beserta tools dan alasan mengapa memilih design dan tools tersebut.
2.	Bagaimana menangani keamaanan dalam pengiriman data (backend dan mobile apps) pada sistem diatas.
 .	Jelaskan solusi tersebut beserta alasannya.
3.	Buatlah sebuah service backend sederhana dengan operasi dasar CRUD ditambah salah satu implementasi keamanan pada soal no 2 beserta unit test nya. Boleh menggunakan bahasa apapun.

JAWAB

1.	Aplikasi Antar Makanan dan Pelanggan : anter.in
Fungsi stack backend Apps:
1.	Data Pengguna
2.	Data Merchant 
3.	Data Product (Makanan)
4.	Data Tarif
5.	Data Kupon
6.	Data Transaksi
7.	Data Admin
Tools yang digunakan :
1.	Bahasa pemrograman yang digunakan : PHP, menggunakan framework MVC, OOP buatan sendiri. Alasannya PHP merupakan Bahasa yang cukup popular dan kecepatannya juga tak kalah dengan Bahasa-bahasa yang mendekati mesin seperti phyton dan ruby. Cocok untuk skala kecil menengah, mungkin apabila skala sudah besar bisa dipertimbangkan menggunakan Golang.
Disisi lain, PHP adalah Bahasa familiar dan dapat dengan mudah dikerjakan bersama Tim.
2.	Database yang digunakan : Mysql, alasannya adalah Free dan cocok sebagai pendamping PHP. Mysql juga sangat popular dan terus ditingkatkan keamananya.
3.	Tool Editor yang digunakan adalah Sublime, Alasan mengapa menggunakan Sublime adalah banyaknya fitur-fitur package yang memadai dalam pemrograman backend web. Seperti HTML, JSON, CSS Beuatifier untuk menulis kode yang cantik dan mudah dipahami.





2.	Cara saya dalam meningkatkan keamanan data yang dikirim melalui webservice. Adalah sebagai berikut :
-	Penggunaan UUID versi 5 sebagai pengganti ID Primary Key unik setiap table. Dimana UUID ini terdiri dari 32 character md5, ini sangat membantu daripada menggunakan auto increament ID. Contohnya pada ID User menggunakan UUID ini jelas sangat membingungkan Hacker karena terdiri dari kode acak.
-	Penggunakan Anti SQl Injection pada setiap berhubungan dengan database dari PHP
-	Memanfaatkan Password MD5 dengan pre_string yang mana dapat mengamankan password apabila terjadi pembobolan.
-	Menggunakan sistem token pada setiap user login, dimana token tersebut tergenerate berdasarkan login user apabila digunakan oleh oknum yang menyekat komunikasi kita akan terjaring.
-	Menggunakan sistem imei login, jadi apabila user login menggunakan handphone orang lain (bukan handphone yang biasanya dipakai) maka akan diwajibkan verifikasi akses melalui email ataupun SMS. Ini tentu berefek dengan penyimpanan imei hp user di database.





3.  Backend Apps anter.in

apps > mvc dan config
assets > libraries and private assets
db > database file
public > public upload assest

Silahkan ganti konfigurasi database di apps/config/config_db.php
Silahkan ganti konfigurasi site di apps/config/config_site.php