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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/core-js-bundle@3.33.3/minified.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h1>Hello admin</h1>
    <button onclick="logout(event)">Logout</button>

    <section class="container my-5">
    <h2 class="fw-bold mb-4">Users</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr><th>#</th><th>Name</th><th>Status</th></tr>
        </thead>
        <tbody>
            <tr><td>1</td><td>Alice</td><td><span class="badge bg-success">Active</span></td></tr>
            <tr><td>2</td><td>Bob</td><td><span class="badge bg-warning text-dark">Pending</span></td></tr>
            <tr><td>3</td><td>Charlie</td><td><span class="badge bg-danger">Banned</span></td></tr>
        </tbody>
        </table>
    </div>
    </section>

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