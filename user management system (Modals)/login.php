<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- Bootstrap & CoreJS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/core-js-bundle@3.33.3/minified.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card shadow-sm">
          <div class="card-body">
            <h4 class="text-center mb-4">Login</h4>
            <form id="loginForm">
              <div class="mb-3">
                <input type="text" id="username" class="form-control" placeholder="Username">
              </div>
              <div class="mb-3">
                <input type="password" id="password" class="form-control" placeholder="Password">
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
            </form>
            <div class="mt-3 text-center">
              <a href="register.php">Create an account</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const loginForm = document.getElementById('loginForm');

      loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const data = {
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
              title: 'Welcome!',
              text: result.message,
              timer: 1500,
              showConfirmButton: false
            });

            setTimeout(() => {
              window.location.href = result.is_admin ? 'all_users.php' : 'index.php';
            }, 1500);
          } else {
            Swal.fire('Error', result.message, 'error');
          }
        } catch (error) {
          Swal.fire('Error', error.message, 'error');
        }
      });
    });
  </script>
</body>
</html>