<?php
session_start();
require __DIR__ . "./connection.php"; // adjust if needed

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT id, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // ✅ HASH CHECK
        if (password_verify($password, $user["password"])) {

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["email"]   = $user["email"];

            echo "LOGIN SUCCESS";
            // header("Location: dashboard.php");
            exit;

        } else {
            echo "Wrong password";
        }
    } else {
        echo "Email not found";
    }
}
