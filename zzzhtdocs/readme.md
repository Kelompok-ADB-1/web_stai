$conn = new mysqli($host, $user, $pass, $db, $port);

// main koneksi di file /masuk/connection.php

ada juga pada file:

dashboard\admin\data-akun\delete_user.php
dashboard\admin\data-akun\insert_user.php
dashboard\admin\data-akun\update_user.php
>> tapi dashboard\admin\data-akun\index.php menggunakan koneksi dari file /masuk/connection.php

dashboard\admin\keuangan\index.php   or   dashboard\pembayaran\index.php  from /masuk/connection.php

profil or akun same

vv

dashboard\upload-berkas\getdata\testview\index.php
dashboard\upload-berkas\getdata\index.php

dashboard\upload-berkas\upload_foto.php
dashboard\upload-berkas\delete_foto.php
>> while dashboard\upload-berkas\index.php menggunakan koneksi dari file /masuk/connection.php


*note:
>> be careful phpMyAdmin (MySQL) and DIR tree (folder) structure error.
>> next time singkat .css and navbar / footer / header / sidebar / etc .php


















