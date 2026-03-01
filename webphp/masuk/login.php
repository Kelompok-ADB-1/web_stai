<?php
// Show errors for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();

// Include database connection
require __DIR__ . "/connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';

    // Prepare SQL statement (Joined with userdata to get nama_mhs)
    $sql = "SELECT users.id, users.email, users.password, users.role, userdata.nama_mhs 
            FROM users 
            LEFT JOIN userdata ON users.id = userdata.id 
            WHERE users.email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("SQL prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($password === $user["password"]) {
            $_SESSION["id"] = $user["id"];
            $_SESSION["email"]   = $user["email"];
            $_SESSION["role"]    = $user["role"];
            $_SESSION["nama_mhs"] = $user["nama_mhs"];

            $redirect = ($user["role"] === 'admin') ? "../dashboard/admin/" : "../dashboard/";

            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode(["status" => "success", "redirect" => $redirect]);
                exit;
            }

            header("Location: " . $redirect);
            exit;
        } else {
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode(["status" => "error", "message" => "Password salah!"]);
                exit;
            }
            echo "<script>alert('Wrong password'); window.history.back();</script>";
        }
    } else {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode(["status" => "error", "message" => "Email tidak ditemukan!"]);
            exit;
        }
        echo "<script>alert('Email not found'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}