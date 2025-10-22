<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
} else if (!$_SESSION['is_admin']) {
    header("Location: index.php");
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
    <h1>Hello admin</h1>
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
                    window.location.href = "index.php";
                } else {
                    errorModalBody.textContent = result.message;
                    errorModal.show();
                }
            } catch (error) {
                errorModalBody.textContent = error;
                errorModal.show();
            }
        }
    </script>
</body>
</html>