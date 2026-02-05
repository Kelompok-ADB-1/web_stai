<?php
echo "user1: " . password_hash("123456", PASSWORD_DEFAULT) . "<br>";
echo "user2: " . password_hash("password", PASSWORD_DEFAULT) . "<br>";
echo "admin: " . password_hash("admin123", PASSWORD_DEFAULT) . "<br>";
