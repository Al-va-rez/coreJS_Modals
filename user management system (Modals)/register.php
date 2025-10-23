<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/core-js-bundle@3.33.3/minified.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7">
        <div class="card shadow-sm">
          <div class="card-body">
            <h4 class="text-center mb-4">Register</h4>
            <form id="registerForm">
              <div class="row g-3">
                <div class="col-md-6">
                  <input type="text" id="username" class="form-control" placeholder="Username">
                </div>
                <div class="col-md-6">
                  <input type="text" id="firstname" class="form-control" placeholder="First Name">
                </div>
                <div class="col-md-6">
                  <input type="text" id="lastname" class="form-control" placeholder="Last Name">
                </div>
                <div class="col-md-6">
                  <input type="password" id="password" class="form-control" placeholder="Password">
                </div>
                <div class="col-md-6">
                  <input type="password" id="confirmPass" class="form-control" placeholder="Confirm Password">
                </div>
                <div class="col-md-6 d-flex align-items-center">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="isAdmin">
                    <label class="form-check-label" for="isAdmin">Admin Account</label>
                  </div>
                </div>
              </div>
              <div class="mt-4 d-grid">
                <button type="submit" class="btn btn-success">Register</button>
              </div>
            </form>
            <div class="mt-3 text-center">
              <a href="login.php">Already have an account?</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const registerForm = document.getElementById('registerForm');

      registerForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const data = {
          action: 'create',
          username: document.getElementById('username').value,
          firstname: document.getElementById('firstname').value,
          lastname: document.getElementById('lastname').value,
          password: document.getElementById('password').value,
          confirm_password: document.getElementById('confirmPass').value,
          is_Admin: document.getElementById('isAdmin').checked
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
              title: 'Registered!',
              text: result.message,
              timer: 2000,
              showConfirmButton: false
            });
            setTimeout(() => window.location.href = 'login.php', 2000);
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