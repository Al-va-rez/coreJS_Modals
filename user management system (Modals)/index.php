<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
} else if ($_SESSION['is_admin']) {
    header("Location: all_users.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello user</h1>
</body>
</html>