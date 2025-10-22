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
    <form action="" onsubmit="login(event)">
        <input type="text" id="username" placeholder="username">
        <input type="password" id="password" placeholder="password">
        <button type="submit">Submit</button>
    </form>
    <a href="register.php">Register</a>

    <script>
        async function login(event) {
            event.preventDefault();

            var data = {
                action: 'login',
                username: document.getElementById('username').value,
                password: document.getElementById('password').value
            };

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
                        title: result.status.toUpperCase(),
                        text: result.message,
                        timer: 1500,
                        timerProgressBar: true,
                        confirmButton: 'OK'
                    });
                    setTimeout(() => {
                        if (result.is_admin) {
                            window.location.href = "all_users.php";
                        } else {
                            window.location.href = "index.php";
                        }
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