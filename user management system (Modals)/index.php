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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/core-js-bundle@3.33.3/minified.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h1>Hello user</h1>
    <button onclick="logout(event)">Logout</button>

    <script>
        async function logout(event) {

            var data = {action: 'logout'};

            try {
                const response = await fetch('api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (result.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        text: result.message.toUpperCase(),
                        timer: 1500,
                        timerProgressBar: true
                    });
                    setTimeout(() => {
                        window.location.href = "index.php"
                    }, 1500);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: result.status.toUpperCase(),
                        text: result.message,
                        confirmButton: 'OK'
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: result.status.toUpperCase(),
                    text: result.message,
                    confirmButton: 'OK'
                });
            }
        }
    </script>
</body>
</html>