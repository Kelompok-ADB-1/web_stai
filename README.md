# web_stai


# AKADEMI DIGITAL BANDUNG

# PRODI TEKNOLOGI REKAYASA PERANGKAT LUNAK

# 2026


## BAB I PENDAHULUAN

## 1.1. Latar Belakang

Perkembangan Teknologi Informasi dan Komunikasi (TIK) telah mengubah paradigma
pengelolaan informasi dalam institusi pendidikan. Perguruan tinggi tidak lagi hanya
mengandalkan media konvensional dalam penyebaran informasi dan proses administrasi, tetapi
dituntut untuk mengimplementasikan sistem informasi berbasis web yang terintegrasi, efisien,
dan mudah diakses.
Secara teoritis, sistem informasi berbasis web merupakan kombinasi antara teknologi,
manusia, dan prosedur kerja yang dirancang untuk mengolah, menyimpan, dan
mendistribusikan informasi secara digital melalui jaringan internet.
Berdasarkan kebutuhan tersebut, perancangan Website Sistem Informasi Penerimaan
Mahasiswa Baru STAI Sabilussalam Bandung dilakukan sebagai solusi digital untuk
meningkatkan efektivitas, efisiensi, dan kualitas layanan PMB.

## 1.2. Tujuan Perancangan

Perancangan Website Sistem Informasi Penerimaan Mahasiswa Baru (PMB) ini
bertujuan untuk mengimplementasikan konsep Sistem Informasi Manajemen (SIM) dalam
mendukung proses penerimaan mahasiswa baru yang terstruktur, sistematis, dan terintegrasi.
Melalui pendekatan ini, seluruh alur pendaftaran mulai dari pengisian formulir, verifikasi data,
hingga proses seleksi dapat dikelola dalam satu sistem yang terpadu sehingga meningkatkan
efektivitas pengelolaan informasi.
**Website ini bertujuan untuk:**
➔ Menyediakan informasi akademik dan institusional secara cepat dan akurat
➔ Menjadi media promosi kampus bagi calon mahasiswa
➔ Mempermudah proses Penerimaan Mahasiswa Baru (PMB)
➔ Mendukung kegiatan administrasi akademik
➔ Meningkatkan citra dan profesionalitas institusi


## BAB II ARSITEKTUR SISTEM

## 2.1 Gambaran Umum Sistem

Sistem Informasi & PMB dibangun menggunakan arsitektur berbasis web dengan
struktur client-server. Arsitektur ini memungkinkan pemisahan antara antarmuka pengguna
(client side) dan pengolahan data (server side), sehingga sistem menjadi lebih terstruktur,
fleksibel, dan mudah dikembangkan.. Sistem ini terdiri dari tiga komponen utama:
1) **Frontend (Client Side)**
Bagian sistem yang berjalan di browser pengguna menggunakan HTML, CSS, dan
JavaScript untuk menampilkan data dinamis. Frontend bertanggung jawab
menampilkan antarmuka pengguna seperti landing page, halaman informasi, formulir
pendaftaran, serta dashboard pengguna.
2) **Backend (Server Side)**
Bagian sistem di server yang dikembangkan dengan PHP. Backend menangani
autentikasi, validasi data, pengelolaan hak akses, dan komunikasi dengan database
MySQL. Frontend menggunakan JavaScript untuk mengirim permintaan GET (ambil
data) atau POST (kirim data) ke backend, yang kemudian memproses dan
mengembalikan data dalam format JSON.
3) **Database (MySQL)**
Sistem penyimpanan data menggunakan MySQL yang menyimpan informasi akun
pengguna, data calon mahasiswa, dokumen, bukti pembayaran, dan data lainnya.
Database dikelola melalui phpMyAdmin sebagai antarmuka administrasi.
Dengan integrasi ketiga komponen tersebut, sistem mampu berjalan secara efektif, terpusat, dan
mendukung kebutuhan administrasi PMB secara digital.

## 2.2 Role-Based System (Sistem Berbasis Peran)

Sistem Informasi PMB ini menerapkan metode Role-Based Access Control, yaitu
mekanisme pengaturan hak akses berdasarkan peran pengguna dalam sistem, ini diterapkan
dengan bertujuan untuk meningkatkan keamanan sistem dengan membatasi akses pengguna
hanya pada fitur dan data yang sesuai dengan tanggung jawabnya. Dalam sistem ini terdapat tiga
peran utama, yaitu Admin, Dosen, dan Calon Mahasiswa.
1) **Admin**
Bertanggung jawab mengelola seluruh akun pengguna sistem, mendaftarkan akun
sistem, melakukan verifikasi dokumen pendaftaran, mengatur jadwal seleksi, mengubah
informasi website terkait status seleksi dan mengawasi keseluruhan sistem.
2) **Calon Mahasiswa**
Merupakan pengguna utama dalam proses PMB. Mereka dapat melakukan registrasi
akun, melengkapi formulir pendaftaran, mengunggah dokumen persyaratan, serta
memantau informasi terkait ujian dan status seleksi.
Penerapan sistem berbasis peran ini memastikan bahwa setiap pengguna dapat menjalankan
fungsinya secara optimal tanpa mengganggu keamanan dan stabilitas sistem secara keseluruhan.


## BAB III FITUR WEBSITE

## 3.1 Landing Page

Landing page berfungsi sebagai pintu utama bagi pengunjung untuk mengenal institusi,
program studi, dan proses pendaftaran. Halaman ini dirancang untuk menampilkan informasi
inti secara jelas dan menarik, memudahkan calon mahasiswa dalam memahami informasi terkait
PMB. Landing page juga bertindak sebagai media branding, menekankan nilai-nilai kampus.
**Tujuan:**
➔ Memberikan informasi lengkap mengenai STAI Sabilussalam, visi, misi, dan profil
kampus.
➔ Mempermudah calon mahasiswa dalam memahami program studi dan keunggulan
akademik.
➔ Menyediakan panduan proses pendaftaran secara cepat, mudah, dan transparan.
➔ Memperkuat komunikasi dengan pengunjung melalui kontak langsung dan dukungan
online.
**Komponen Utama Landing Page:**
1) Header & Banner Utama
a) Menampilkan slogan.
b) Call-to-action untuk pendaftaran mahasiswa baru.
2) Deskripsi Singkat Kampus
a) Profil kampus.
b) Informasi terkait program studi / jurusan.
c) Fokus dan keunggulan kampus.
3) Informasi Proses Pendaftaran
a) Menjelaskan secara singkat terkait alur proses PMB.
4) Kontak dan Lokasi
a) Info email, nomor hp, dan alamat lengkap.
5) Navigation bar dan Footer Website
a) Berisi tombol menu yang mengarahkan pengguna ke berbagai halaman (index)
lainnya, sehingga memudahkan navigasi dan akses informasi di dalam website.
Landing page ini dirancang dengan navigasi yang mudah menggunakan anchor link
yang mengarah ke setiap bagian utama, sehingga pengunjung dapat dengan cepat menemukan
informasi yang dibutuhkan. Terdapat call-to-action yang menonjol untuk pendaftaran,
memudahkan calon mahasiswa melakukan registrasi.
Halaman ini ditampilkan pada index.php. Selain itu, pada navbar tersedia beberapa
tombol yang mengarah ke halaman index.php lainnya untuk menampilkan informasi yang lebih
lengkap, seperti halaman Jurusan Kampus, Petunjuk Pendaftaran yang lebih detail, serta FAQ
untuk menjawab berbagai pertanyaan. Tersedia juga tombol Daftar dan Masuk untuk
memudahkan pengguna dalam melakukan registrasi maupun login.


## 3.2 Manajemen Akun

Halaman Manajemen Akun dirancang untuk memudahkan pengguna dalam mengelola
informasi akun secara mandiri. Melalui halaman ini, pengguna dapat memperbarui data pribadi,
mengubah kata sandi, serta memastikan informasi kontak yang terdaftar selalu akurat dan
terbaru.
**Tujuan:**
➔ Memudahkan pengguna dalam mengelola dan memperbarui data pribadi secara mandiri.
➔ Menjaga keakuratan dan kelengkapan informasi akun yang tersimpan dalam sistem.
➔ Memberikan akses yang cepat untuk melihat status pendaftaran atau aktivitas akun.
**Komponen Utama Manajemen Akun:**
1) Login dan Logout
a) Validasi email dan password yang terdaftar.
i) Database
(1) Koneksi ke phpMyAdmin pada file /masuk/connection.php,
dengan isi:
$host = "localhost";
$user = "kelasweb_adminSTAI"; // username database
$pass = "adminstai123"; // password database
$db = "kelasweb_db_stai"; // nama database
$port = 3306; // port MySQL
(2) Tabel MySQL terkait:
(a) users (id, email, password, role)
(b) calonusers (id, email, password)
b) Session management.
i) Terdapat pada /masuk/login.php, yaitu session jika sudah melakukan
login, terdapat:
$_SESSION["id"] = $user["id"];
$_SESSION["email"] = $user["email"];
$_SESSION["role"] = $user["role"];
$_SESSION["nama_mhs"] = $user["nama_mhs"];
ii) Informasi sessional tersebut disimpan dan akan digunakan jika perlu
c) Redirect otomatis berdasarkan role.
2) Pengelolaan Akun
a) Bisa mengganti password akun sendiri.
b) Admin memiliki akses penuh terhadap pengelolaan akun, meliputi
i) Menambah, menghapus, atau mengubah data akun.
ii) Mengubah role akun user.
Fitur Login dan Logout memungkinkan pengguna masuk ke sistem dengan validasi
email dan password yang terdaftar pada database, dilengkapi dengan session management serta
redirect otomatis berdasarkan role pengguna.


Pada Pengelolaan Akun, pengguna dapat mengganti password akun secara mandiri.
Sementara itu, Admin memiliki akses penuh untuk menambah, menghapus, dan mengubah data
akun, termasuk mengatur atau mengubah role pengguna diantara Admin atau Calon Mahasiswa.

## 3.3 Dashboard Akun

Dashboard Akun menampilkan ringkasan informasi profil, status dokumen, dan
aktivitas-aktivitas yang bisa dilakukan sesuai peran pengguna, sehingga pengguna dapat
memantau dan mengelola akun mereka dengan mudah.
**Tujuan:**
➔ Memberikan ringkasan cepat aktivitas dan progres akun sesuai peran pengguna.
➔ Memudahkan pemantauan status dokumen, seleksi, dan data yang telah dikerjakan.
➔ Menyediakan akses langsung ke fungsi penting seperti pengelolaan profil, password,
dan logout.
**Komponen Dashboard Akun:**
1) Untuk Calon Mahasiswa
a) Dashboard Utama
b) Profil dan Biodata
c) Upload Berkas
d) Pembayaran
e) Hasil Seleksi
2) Untuk Admin
a) Overview
b) Kelola Akun
c) Mata Kuliah
d) Keuangan
e) Seleksi PMB
f) Settings
Dashboard dan Overview ini sebagian data dari menu untuk memperlihatkan ringkasan
dari aktivitas role-nya, dan mengambil progres data-data dari yang sudah dikerjakan dengan
men-select query, meng-assign pada variabel, dan menghitungnya untuk keperluan statistika.
Adapun juga navigation bar yang berada di /dashboard/navbar-dashboard.php untuk
menu akun untuk mengedit password dan juga menu logout. Tampilan navbar ini dinamis
menyesuaikan session role user. Kemudian koneksi pada database masih mengambil dari
/../masuk/connection.php.

## 3.4 Input & Verifikasi Dokumen

Fitur Input dan Verifikasi Dokumen memungkinkan pengguna untuk mengunggah
dokumen pendukung yang diperlukan dalam proses pendaftaran atau administrasi lainnya secara
langsung melalui website.
**Tujuan:**
➔ Memudahkan calon mahasiswa atau pengguna lain untuk mengirimkan berkas yang
dibutuhkan secara digital tanpa harus datang langsung ke kantor.
➔ Menjamin berkas tersimpan dengan rapi dan terorganisir di sistem.
➔ Mempercepat proses verifikasi dan administrasi oleh pihak kampus atau admin.


**Komponen Utama Input & Verifikasi Dokumen:**
1) Untuk Calon Mahasiswa:
a) Upload Berkas (dashboard/upload-berkas/)
i) Calon mahasiswa dapat memilih dan mengunggah file dokumen
mereka berupa pas foto, ijazah, ktp, kk, akta kelahiran, dan sertifikat
(opsional).
ii) Tabel MySQL terkait:
(1) users (id, email, password, role)
(2) userberkas (id*, pas_foto, ijazah, ktp, kk, akta, prestasi)
b) Upload Pembayaran (dashboard/pembayaran/)
i) Calon mahasiswa melihat daftar pembayaran yang harus dibayar dan
dapat mengunggah file bukti pembayaran.
ii) Calon mahasiswa melihat status diantaranya yaitu ‘Menunggu
Pembayaran’ ketika belum bayar, ‘Verifikasi’, dan ‘Lunas’.
iii) Calon mahasiswa dapat melihat daftar riwayat transaksi yang sudah
dibayar dengan ditampilkan informasi terkait id transaksi (contoh:
pendaftaran), tanggal, jenis, jumlah, dan status.
iv) Tabel MySQL terkait:
(1) users (id, email, password, role)
(2) userpembayaran (id*, transaksi_id*, bukti_bayar, nominal,
status, tanggal_upload, keterangan)
(3) transaksipembayaran (id, nama_pembayaran, nominal_default)
c) Input Profil dan Biodata (dashboard/profil)
i) Calon mahasiswa dapat mengisi dan mengupdate data pribadi terkait
nama lengkap, nik, alamat, tempat/tanggal lahir, dan juga memilih
program studi yang akan dipilih.
ii) Tabel MySQL terkait:
(1) users (id, email, password, role)
(2) userdata (id*, nama_mhs, jurusan, nik, alamat, tempat_lahir,
tanggal_lahir)
2) Untuk Admin
a) Kelola Akun (dashboard/admin/data-akun/)
i) Admin melihat progres pendaftaran data calon mahasiswa.
ii) Admin melihat, menambah, hapus, dan edit akun yang terdaftar pada
database sistem. Jika menambahkan akun password default akan sama
dengan email user.
b) Kelola Keuangan (dashboard/admin/keuangan/)
i) Admin melihat dashboard statistik laporan keuangan yang didapat dari
pembayaran proses PMB, berupa total pendapatan, jumlah calon
mahasiswa yang belum bayar, dan jumlah pembayaran sudah lunas, dan
pembayaran yang ditolak.
ii) Admin melihat dan memverifikasi daftar pembayaran calon mahasiswa,
dengan status ‘menunggu’ yaitu calon mahasiswa belum upload (tidak
ditampilkan di dashboard), ’‘verifikasi’ artinya calon mahasiswa sudah
upload dan menunggu diverifikasi admin, ‘berhasil’, ‘ditolak’.


3) Struktur File dan Database
a) File Dokumen
i) File unggahan dari calon mahasiswa disimpan pada file manager
dengan struktur folder terorganisir berdasarkan jenis dokumen dan
modul terkait, sehingga memudahkan pengelolaan, akses, dan
verifikasi. Berikut adalah gambaran tree dari file manager dashboard:
dashboard
├── admin
│ ├── data-akun
│ │ └── getdata
│ ├── keuangan
│ ├── mata-kuliah
│ ├── seleksi
│ └── settings
├── akun
├── hasil-seleksi
├── pembayaran
│ └── getdata
│ └── uploads_pembayaran
├── profil
│ └── getdata
└── upload-berkas
└── getdata
├── testview
└── uploads
File yang diunggah akan disimpan di folder getdata/uploads pada menu
masing-masing.
b) Database
i) Koneksi ke phpMyAdmin
(1) Koneksi ke database dilakukan melalui phpMyAdmin
menggunakan:
$host = "localhost";
$user = "kelasweb_adminSTAI"; // username database
$pass = "adminstai123"; // password database
$db = "kelasweb_db_stai"; // nama database
$port = 3306; // port MySQL
(2) Kode koneksi di atas disimpan di file index.php, insert.php, dan
delete.php pada direktori masing-masing, sehingga setiap file
dapat terhubung ke database untuk menampilkan, menambah,
atau menghapus data sesuai fungsinya.
ii) Tabel MySQL terkait:
(1) users (id, email, password, role)
(2) userberkas (id*, pas_foto, ijazah, ktp, kk, akta, prestasi) 
(3) userdata (id*, nama_mhs, jurusan, nik, alamat, tempat_lahir,
tanggal_lahir)
(4) userpembayaran (id*, transaksi_id*, bukti_bayar, nominal,
status, tanggal_upload, keterangan)
(5) transaksipembayaran (id, nama_pembayaran, nominal_default)
Dengan komponen tersebut, fitur Input dan Verifikasi Dokumen dapat berjalan dengan
lancar dan terstruktur sesuai alur sistem.

## 3.5 Seleksi PMB

Fitur Seleksi PMB memungkinkan admin untuk mengelola dan memperbarui status
kelulusan calon mahasiswa secara langsung, termasuk menandai apakah mereka lulus atau tidak.
Sementara itu, calon mahasiswa dapat memantau status seleksi mereka melalui sistem, lengkap
dengan informasi terkait seperti nilai ujian, jurusan yang diterima, dan keterangan tambahan
lainnya.
Untuk proses ujian, sistem saat ini masih mengandalkan metode eksternal, baik berupa
ujian kertas maupun menggunakan Google Form atau tes lainnya, karena fitur ujian online
belum terimplementasi di web ini.
**Komponen Utama Input & Verifikasi Dokumen:**
1) Untuk Admin:
a) Halaman Kelola Seleksi PMB (dashboard/admin/seleksi/)
i) Admin melihat daftar calon mahasiswa yang ada dengan kolom id,
nama mahasiswa, jurusan, nilai, status.
ii) Ketika proses ujian telah dilakukan, admin bisa mengedit data dengan
menekan tombol aksi, dan menginput data nilai, status kelulusan, dan
catatan tambahan.
iii) status mahasiswa diantaranya ‘Diterima’, ‘Tidak diterima’, ‘Belum
Ditentukan’.
2) Untuk Calon Mahasiswa:
a) Halaman Hasil Seleksi
i) Calon mahasiswa bisa melihat hasil seleksi dari halaman ini dan juga
melihat informasi terkait nilai ujian, jurusan, dan juga catatan
tambahan.
ii) Tabel MySQL terkait:
(1) users (id, email, password, role)
(2) userdata (id*, nama_mhs, jurusan, nik, alamat, tempat_lahir,
tanggal_lahir)
(3) userseleksi (id*, status_mahasiswa, nilai_ujian, catatan)
iii) Koneksi dengan database MySQL dilakukan melalui
../admin/data-akun/getdata/index.php, yang berisi data akun dalam
format JSON hasil pembaruan oleh admin. Jika status_mahasiswa
bernilai null, maka halaman tidak menampilkan informasi apa pun.


## BAB IV STRUKTUR DATABASE

## 4.1 Tabel MySQL

Dalam database terdapat struktur tabel MySQL yang digunakan dalam sistem, termasuk
kolom dan relasinya, untuk menyimpan data pengguna, dokumen, dan hasil seleksi secara
terorganisir. Koneksi ke database menggunakan konfigurasi:
$user = "kelasweb_adminSTAI"; // username database
$pass = "adminstai123"; // password database
$db = "kelasweb_db_stai"; // nama database
$port = 3306; // port MySQL
**Berikut adalah seluruh tabel dengan detail field yang ada pada database:**
1) users
a) id: INT
b) email: VARCHAR(255)
c) password: VARCHAR(255)
d) role: ENUM('admin',
'calon_mahasiswa')
2) calonusers
a) id: INT
b) email: VARCHAR(255)
c) password: VARCHAR(255)
3) userberkas
a) id: INT
b) pas_foto: VARCHAR(255)
c) ijazah: VARCHAR(255)
d) ktp: VARCHAR(255)
e) kk: VARCHAR(255)
f) akta: VARCHAR(255)
g) prestasi: VARCHAR(255)
h) profile_pic:
VARCHAR(255)
4) userdata
a) id: INT
b) nama_mhs: VARCHAR(255)
c) jurusan: VARCHAR(255)
d) nik: VARCHAR(20)
e) alamat: VARCHAR(255)
f) tempat_lahir:
VARCHAR(255)
g) tanggal_lahir: DATE
5) userpembayaran
a) id: INT
b) transaksi_id: VARCHAR(50)
c) bukti_bayar:
VARCHAR(255)
d) nominal: INT
e) status: ENUM('menunggu',
'verifikasi','berhasil','ditolak')
f) tanggal_upload:
TIMESTAMP
g) keterangan: TEXT
6) transaksipembayaran
a) id: VARCHAR(50)
b) nama_pembayaran:
VARCHAR(255)
c) nominal_default: INT
7) userseleksi
a) id: INT
b) status_mahasiswa:
ENUM('diterima','tidak
diterima','pending')
c) nilai_ujian: DECIMAL(5,2)
d) catatan: TEXT


## 4.2 File Manager Directory

Setiap dokumen atau berkas disimpan pada menu dengan terstruktur.
**Berikut adalah gambaran tree seluruh file:**
stai_pmb/
├─ config.php
├─ style.css
├─ index.php
├─ navbar.php
├─ footer.php
├─ init_db.php
├─ logo_stai-01.svg
├─ div_bg.png
├─ daftar/
│ ├─ index.php
│ └─ success/
│ ├─ index.php
│ └─ insert_calonusers.php
├─ dashboard/
│ ├─ index.php
│ ├─ dashboard.css
│ ├─ navbar-dashboard.php
│ ├─ admin/
│ │ ├─ index.php
│ │ ├─ data-akun/
│ │ │ ├─ index.php
│ │ │ ├─ insert_user.php
│ │ │ ├─ update_user.php
│ │ │ ├─ delete_user.php
│ │ │ └─ getdata/index.php
│ │ ├─ keuangan/
│ │ │ ├─ index.php
│ │ │ └─ update_status.php
│ │ ├─ mata-kuliah/index.php
│ │ ├─ seleksi/
│ │ │ ├─ index.php
│ │ │ └─ update_userseleksi.php
│ │ └─ settings/index.php
│ ├─ akun/index.php
│ ├─ hasil-seleksi/index.php
│ ├─ pembayaran/
│ │ ├─ index.php
│ │ ├─ upload_pembayaran.php
│ │ ├─ cancel_pembayaran.php
│ │ └─ getdata/
│ │ ├─ index.php
│ │ └─ uploads_pembayaran/
│ ├─ profil/
│ │ ├─ index.php
│ │ └─ getdata/index.php
│ └─ upload-berkas/
│ ├─ index.php
│ ├─ upload_foto.php
│ ├─ delete_foto.php
│ └─ getdata/
│ ├─ index.php
│ ├─ testview/index.php
│ └─ uploads/


## BAB V EVALUASI

Fase evaluasi bertujuan untuk menilai kinerja sistem secara menyeluruh, mencakup fitur unggah
dan verifikasi dokumen, pengelolaan akun, serta proses seleksi Penerimaan Mahasiswa Baru
(PMB). Evaluasi ini juga menekankan potensi perbaikan jangka panjang untuk meningkatkan
efisiensi, keamanan, dan pengalaman pengguna.
**Evaluasi ini mencakup beberapa aspek berikut:**
1) Kelengkapan dan Keakuratan Data
a) Memastikan seluruh data pengguna, dokumen, pembayaran, dan hasil seleksi
tersimpan dengan benar di database.
b) Memeriksa konsistensi status dokumen, status kelulusan, dan data profil.
2) Kinerja Sistem
a) Menilai kecepatan load dashboard dan proses query database.
b) Memastikan unggahan file dan proses verifikasi berjalan lancar tanpa error.
3) User Experience (UX)
a) Memeriksa kemudahan navigasi untuk admin dan calon mahasiswa.
b) Menilai kejelasan tampilan dashboard, menu akun, dan halaman hasil seleksi.
4) Keamanan Data
a) Mengevaluasi mekanisme autentikasi dan hak akses berdasarkan role.
b) Memastikan data sensitif seperti password dan dokumen tersimpan dengan
aman.
5) Kesesuaian dengan Prosedur
a) Memastikan alur Dokumen sesuai prosedur yang ditetapkan.
b) Menilai integrasi antara frontend, backend, dan database agar alur kerja sesuai
ekspektasi.
Secara keseluruhan, sistem sudah berjalan sesuai fungsinya dan mendukung seluruh
proses Penerimaan Mahasiswa Baru (PMB). Namun, untuk pengembangan jangka panjang,
beberapa aspek masih bisa ditingkatkan.
File Manager dapat dibuat lebih interaktif dan mudah digunakan, dengan dukungan fitur
preview dokumen secara langsung untuk mempercepat verifikasi. Struktur database sebaiknya
lebih rapi dengan normalisasi lengkap, optimasi query, dan integrasi real-time yang lebih baik
agar performa tetap stabil saat menangani banyak data.
Proses verifikasi dan seleksi dapat diotomatisasi menggunakan AI sederhana atau
sistem verifikasi dokumen yang lebih cepat dan akurat. Modul ujian online sebaiknya
diimplementasikan langsung di platform, sehingga nilai calon mahasiswa otomatis tersimpan di
database tanpa bergantung pada metode eksternal.
Selain itu, aspek keamanan dan scalability perlu ditingkatkan melalui enkripsi data,
proteksi terhadap serangan, dan arsitektur database yang mampu mendukung banyak pengguna
secara bersamaan. Dengan perbaikan tersebut, sistem tidak hanya menjadi lebih efisien dan
aman, tetapi juga lebih mudah digunakan dan siap menghadapi skala besar untuk proses PMB di
masa depan.

























====================================================================


https://docs.google.com/document/d/1LjSGYzIIf4d7Ebi5gpjJ210xRcqSh43vQGkTLFK71kc/edit?tab=t.udgyccikaqb5

WEB -> https://kelompok-adb-1.github.io/web_stai/

GITHUB -> https://github.com/Kelompok-ADB-1/web_stai



