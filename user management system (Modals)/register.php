<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/core-js-bundle@3.33.3/minified.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <form action="" onsubmit="register(event)">
        <input type="text" id="username" placeholder="username">
        <input type="text" id="firstname" placeholder="firstname">
        <input type="text" id="lastname" placeholder="lastname">
        <input type="password" id="password" placeholder="password">
        <input type="password" id="confirmPass" placeholder="confirm password">
        <input type="checkbox" id="isAdmin">
        <button type="submit">Submit</button>
    </form>

    <script>
        const messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
        const messageModalLabel = document.getElementById('messageModalLabel');
        const messageModalBody = document.getElementById('messageModalBody');

        async function register(event) {
            event.preventDefault();

            var data = {
                action: 'create',
                username: document.getElementById('username').value,
                firstname: document.getElementById('firstname').value,
                lastname: document.getElementById('lastname').value,
                password: document.getElementById('password').value,
                confirm_password: document.getElementById('confirmPass').value,
                is_Admin: document.getElementById('isAdmin').checked ? true : false
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
                        timer: 3000,
                        timerProgressBar: true
                    });
                    setTimeout(() => {
                        window.location.href = "login.php"
                    }, 3000);
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