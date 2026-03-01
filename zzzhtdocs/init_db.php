<?php
require_once __DIR__ . '/masuk/connection.php';

function printStatus($message, $success = true) {
    echo ($success ? "✅ " : "❌ ") . $message . "<br>";
}

// Disable foreign key checks
$conn->query("SET FOREIGN_KEY_CHECKS = 0");
printStatus("Foreign key checks disabled");

// =======================
// 1️⃣ DATABASE CHECK
// =======================
$dbName = "db_user";
$result = $conn->query("SHOW DATABASES LIKE '$dbName'");

if ($result->num_rows > 0) {
    printStatus("Database '$dbName' already exists");
} else {
    if ($conn->query("CREATE DATABASE $dbName")) {
        printStatus("Database '$dbName' created successfully");
    } else {
        die("❌ Failed to create database: " . $conn->error);
    }
}

$conn->select_db($dbName);
printStatus("Using database '$dbName'");

// =======================
// FUNCTION TO CREATE TABLE
// =======================
function createTable($conn, $tableName, $createSQL) {
    $check = $conn->query("SHOW TABLES LIKE '$tableName'");
    if ($check->num_rows > 0) {
        printStatus("Table '$tableName' already exists");
    } else {
        if ($conn->query($createSQL)) {
            printStatus("Table '$tableName' created successfully");
        } else {
            printStatus("Failed to create table '$tableName': " . $conn->error, false);
        }
    }
}

// =======================
// 2️⃣ USERS TABLE
// =======================
createTable($conn, "users", "
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'calon_mahasiswa') NOT NULL
) ENGINE=InnoDB
");

// Insert default admin
$adminCheck = $conn->query("SELECT id FROM users WHERE id = 1");
if ($adminCheck->num_rows > 0) {
    printStatus("Default admin already exists");
} else {
    if ($conn->query("INSERT INTO users (id, email, password, role) VALUES (1, 'admin', 'admin', 'admin')")) {
        printStatus("Default admin created");
    }
}

// =======================
// 3️⃣ OTHER TABLES
// =======================
createTable($conn, "calonusers", "
CREATE TABLE calonusers(
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB
");

createTable($conn, "userberkas", "
CREATE TABLE userberkas (
    id INT NOT NULL,
    pas_foto VARCHAR(255) DEFAULT NULL,
    ijazah VARCHAR(255) DEFAULT NULL,
    ktp VARCHAR(255) DEFAULT NULL,
    kk VARCHAR(255) DEFAULT NULL,
    akta VARCHAR(255) DEFAULT NULL,
    prestasi VARCHAR(255) DEFAULT NULL,
    profile_pic VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB
");

createTable($conn, "userdata", "
CREATE TABLE userdata (
    id INT NOT NULL,
    nama_mhs VARCHAR(255) DEFAULT NULL,
    jurusan VARCHAR(255) DEFAULT NULL,
    nik VARCHAR(20) DEFAULT NULL,
    alamat VARCHAR(255) DEFAULT NULL,
    tempat_lahir VARCHAR(255) DEFAULT NULL,
    tanggal_lahir DATE DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_userdata_user
        FOREIGN KEY (id) REFERENCES users(id)
        ON DELETE CASCADE
) ENGINE=InnoDB
");

createTable($conn, "transaksipembayaran", "
CREATE TABLE transaksipembayaran (
    id VARCHAR(50) PRIMARY KEY,
    nama_pembayaran VARCHAR(255) NOT NULL,
    nominal_default INT NOT NULL
) ENGINE=InnoDB
");

// Insert default transaksi
$trxCheck = $conn->query("SELECT id FROM transaksipembayaran WHERE id = 'pendaftaran'");
if ($trxCheck->num_rows > 0) {
    printStatus("Default transaksi 'pendaftaran' already exists");
} else {
    if ($conn->query("INSERT INTO transaksipembayaran VALUES ('pendaftaran','Biaya Pendaftaran PMB',250000)")) {
        printStatus("Default transaksi 'pendaftaran' created");
    }
}

createTable($conn, "userpembayaran", "
CREATE TABLE userpembayaran (
    id INT,
    transaksi_id VARCHAR(50),
    bukti_bayar VARCHAR(255) DEFAULT NULL,
    nominal INT DEFAULT 250000,
    status ENUM('menunggu', 'verifikasi', 'berhasil', 'ditolak') DEFAULT NULL,
    tanggal_upload TIMESTAMP NULL DEFAULT NULL,
    keterangan TEXT DEFAULT NULL,
    PRIMARY KEY (id, transaksi_id),
    FOREIGN KEY (id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (transaksi_id) REFERENCES transaksipembayaran(id) ON DELETE CASCADE
) ENGINE=InnoDB
");

createTable($conn, "userseleksi", "
CREATE TABLE userseleksi (
    id INT NOT NULL,
    status_mahasiswa ENUM('diterima','tidak diterima','pending') DEFAULT 'pending',
    nilai_ujian DECIMAL(5,2) DEFAULT NULL,
    catatan TEXT DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB
");

// Enable foreign keys again
$conn->query("SET FOREIGN_KEY_CHECKS = 1");
printStatus("Foreign key checks enabled");

printStatus("Database initialization finished 🎉");

$conn->close();
?>