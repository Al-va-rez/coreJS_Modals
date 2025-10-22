<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/core-js-bundle@3.33.3/minified.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <form action="" onsubmit="login(event)">
        <input type="text" id="username" placeholder="username">
        <input type="password" id="password" placeholder="password">
        <button type="submit">Submit</button>
    </form>
    <a href="register.php">Register</a>

    <!-- Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="errorModalLabel">Login Failed</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="errorModalBody">
                Invalid username or password.
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>

    <script>
        const errorModalEl = document.getElementById('errorModal');
        const errorModal = new bootstrap.Modal(errorModalEl);
        const errorModalBody = document.getElementById('errorModalBody');

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
                    if (result.is_admin) {
                        window.location.href = "all_users.php";
                    } else {
                        window.location.href = "index.php";
                    }
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